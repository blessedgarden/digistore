<?php

namespace App\Http\Controllers;

use App\Models\Promo;
use App\Services\CartService;
use Illuminate\Http\Request;

class PromoController extends Controller
{
    protected $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function apply(Request $request)
    {
        $request->validate([
            'promo_code' => 'required|string|max:50',
        ]);

        $code = strtoupper(trim($request->promo_code));

        // Ищем промокод
        $promo = Promo::where('code', $code)->first();

        // Промокод не найден
        if (!$promo) {
            return response()->json([
                'success' => false,
                'message' => '❌ Промокод не найден'
            ], 422);
        }

        // Промокод неактивен
        if (!$promo->active) {
            return response()->json([
                'success' => false,
                'message' => '❌ Промокод неактивен'
            ], 422);
        }

        // Промокод истёк
        if ($promo->expires_at && $promo->expires_at->isPast()) {
            return response()->json([
                'success' => false,
                'message' => '❌ Срок действия промокода истёк'
            ], 422);
        }

        // Лимит использований
        if ($promo->current_uses >= $promo->max_uses) {
            return response()->json([
                'success' => false,
                'message' => '❌ Промокод больше недоступен'
            ], 422);
        }

        // Корзина пустая
        $cartTotal = $this->cartService->getCartTotal();
        if ($cartTotal <= 0) {
            return response()->json([
                'success' => false,
                'message' => '❌ Корзина пуста'
            ], 422);
        }

        // Вычисляем скидку
        $discount = 0;
        $discountText = '';

        if ($promo->discount_percent) {
            $discount = round(($cartTotal * $promo->discount_percent) / 100, 2);
            $discountText = "{$promo->discount_percent}%";
        } elseif ($promo->discount_amount) {
            $discount = min($promo->discount_amount, $cartTotal);
            $discountText = number_format($promo->discount_amount, 0, '', ' ') . " ₽";
        }

        // Сохраняем в сессию
        session()->put('discount', $discount);
        session()->put('promo_code', $code);
        session()->put('promo_id', $promo->id);

        // Увеличиваем счётчик использований
        $promo->increment('current_uses');

        return response()->json([
            'success' => true,
            'message' => "✅ Промокод применён! Скидка {$discountText}",
            'discount' => $discount,
            'discount_text' => $discountText,
            'final_total' => max(0, $cartTotal - $discount),
            'promo_code' => $code,
        ]);
    }

    public function remove(Request $request)
    {
        $promoId = session()->get('promo_id');

        // Если промокод был применен - уменьшаем счётчик
        if ($promoId) {
            $promo = Promo::find($promoId);
            if ($promo && $promo->current_uses > 0) {
                $promo->decrement('current_uses');
            }
        }

        session()->forget(['discount', 'promo_code', 'promo_id']);

        return response()->json([
            'success' => true,
            'message' => 'Промокод удалён',
            'final_total' => $this->cartService->getCartTotal(),
        ]);
    }
}