<?php

namespace App\Http\Controllers;

use App\Services\CartService;
use App\Models\Product;
use App\Models\Promo;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $cart = $this->cartService->getCart();
        $total = $this->cartService->getCartTotal();
        $discount = session()->get('discount', 0);
        $promoCode = session()->get('promo_code', null);
        $finalTotal = $total - $discount;

        return view('cart.index', compact(
            'cart',
            'total',
            'discount',
            'finalTotal',
            'promoCode'
        ));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $product = Product::findOrFail($request->product_id);
        $subscriptionPeriod = $request->get('subscription_period', '1_month');

        $this->cartService->addToCart(
            $product->id,
            $product->name,
            $product->price,
            $subscriptionPeriod
        );

        // Для AJAX запросов
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Товар добавлен в корзину',
                'cartCount' => $this->cartService->getCartCount(),
            ]);
        }

        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function remove(Request $request, $productId)
    {
        $this->cartService->removeFromCart($productId);

        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Товар удален из корзины',
                'cartCount' => $this->cartService->getCartCount(),
            ]);
        }

        return redirect()->back()->with('success', 'Товар удален из корзины');
    }

    public function applyPromo(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string',
        ]);

        $code = strtoupper($request->promo_code);
        $promo = Promo::where('code', $code)
            ->where('active', true)
            ->first();

        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => 'Промокод не найден или неверен',
            ], 422);
        }

        // Проверяем лимит использований
        if ($promo->current_uses >= $promo->max_uses) {
            return response()->json([
                'success' => false,
                'message' => 'Лимит использований промокода исчерпан',
            ], 422);
        }

        // Проверяем срок действия
        if ($promo->expires_at && $promo->expires_at < now()) {
            return response()->json([
                'success' => false,
                'message' => 'Промокод истёк',
            ], 422);
        }

        // Вычисляем скидку
        $cartTotal = $this->cartService->getCartTotal();
        $discount = 0;

        if ($promo->discount_amount) {
            $discount = min($promo->discount_amount, $cartTotal);
        } elseif ($promo->discount_percent) {
            $discount = ($cartTotal * $promo->discount_percent) / 100;
        }

        // Сохраняем скидку в сессию
        session()->put('discount', $discount);
        session()->put('promo_code', $code);

        return response()->json([
            'success' => true,
            'message' => "Промокод применён! Скидка: {$discount} ₽",
            'discount' => $discount,
            'finalTotal' => $cartTotal - $discount,
        ]);
    }
}