<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with('items')
            ->latest()
            ->paginate(10);

        return view('profile.orders', compact('orders'));
    }

    public function show(Order $order)
    {
        // Проверяем, что заказ принадлежит текущему пользователю
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.digitalKey');

        // Получаем цифровые ключи
        $digitalKeys = [];
        foreach ($order->items as $item) {
            if ($item->digitalKey) {
                $digitalKeys[$item->product_name] = $item->digitalKey->key_value;
            }
        }

        return view('order.show', compact('order', 'digitalKeys'));
    }
}