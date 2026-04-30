<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\DigitalKey;
use Illuminate\Support\Str;

class OrderService
{
    public function createOrder($userId, $cartItems, $discount = 0)
    {
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += $item['price'] * $item['quantity'];
        }

        $total = $subtotal - $discount;

        $order = Order::create([
            'user_id' => $userId,
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total' => $total,
            'status' => 'pending',
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['id'],
                'product_name' => $item['name'],
                'subscription_period' => $item['subscription_period'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
            ]);
        }

        return $order;
    }

    public function markAsPaid($orderId)
    {
        $order = Order::find($orderId);
        $order->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        // Генерируем ключи для каждого товара в заказе
        foreach ($order->items as $item) {
            $this->assignDigitalKey($item);
        }

        return $order;
    }

    public function assignDigitalKey($orderItem)
    {
        $availableKey = DigitalKey::where('product_id', $orderItem->product_id)
            ->where('status', 'available')
            ->first();

        if ($availableKey) {
            $availableKey->update([
                'order_item_id' => $orderItem->id,
                'status' => 'sold',
            ]);
        }
    }
}