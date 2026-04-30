<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Services\OrderService;
use App\Services\PaymentService;
use App\Services\EmailService;
use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    protected $cartService;
    protected $orderService;
    protected $paymentService;
    protected $emailService;

    public function __construct(
        CartService $cartService,
        OrderService $orderService,
        PaymentService $paymentService,
        EmailService $emailService
    ) {
        $this->cartService = $cartService;
        $this->orderService = $orderService;
        $this->paymentService = $paymentService;
        $this->emailService = $emailService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        $total = $this->cartService->getCartTotal();
        $discount = session()->get('discount', 0);
        $promoCode = session()->get('promo_code', null);
        $finalTotal = $total - $discount;

        $user = auth()->user();

        return view('checkout.index', compact(
            'cart',
            'total',
            'discount',
            'finalTotal',
            'promoCode',
            'user'
        ));
    }

    public function process(Request $request)
    {
        $request->validate([
            'payment_method' => 'required|in:card,paypal,crypto',
            'card_number' => 'required_if:payment_method,card|digits:16',
            'card_cvv' => 'required_if:payment_method,card|digits:3',
            'card_expiry' => 'required_if:payment_method,card',
        ]);

        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Корзина пуста');
        }

        // Валидация платёжных данных (для учебного проекта)
        if ($request->payment_method === 'card') {
            $isValid = $this->paymentService->validatePaymentDetails(
                $request->card_number,
                $request->card_cvv,
                $request->card_expiry
            );

            if (!$isValid) {
                return back()->with('error', 'Неверные данные карты');
            }
        }

        // Создаём заказ
        $discount = session()->get('discount', 0);
        $order = $this->orderService->createOrder(
            auth()->id(),
            $cart,
            $discount
        );

        // Обрабатываем платёж (заглушка)
        $payment = $this->paymentService->processPayment(
            $order->id,
            $request->payment_method
        );

        if ($payment['success']) {
            // Отмечаем заказ как оплаченный
            $this->orderService->markAsPaid($order->id);

            // Отправляем email подтверждение
            $this->emailService->sendOrderConfirmation(auth()->user(), $order);

            // Отправляем email с цифровыми ключами
            $this->emailService->sendDigitalKeyEmail(auth()->user(), $order);

            // Очищаем корзину и сессию
            $this->cartService->clearCart();
            session()->forget(['discount', 'promo_code']);

            return redirect()->route('checkout.success', ['order' => $order->order_number])
                ->with('success', 'Заказ успешно оформлен!');
        }

        return back()->with('error', 'Ошибка при обработке платежа. Попробуйте снова.');
    }

    public function success($orderNumber)
    {
        $order = Order::where('order_number', $orderNumber)
            ->where('user_id', auth()->id())
            ->with('items.digitalKey')
            ->firstOrFail();

        // Получаем цифровые ключи
        $digitalKeys = [];
        foreach ($order->items as $item) {
            if ($item->digitalKey) {
                $digitalKeys[$item->product_name] = $item->digitalKey->key_value;
            }
        }

        return view('checkout.success', compact('order', 'digitalKeys'));
    }
}