<?php

namespace App\Services;

class CartService
{
    const CART_SESSION_KEY = 'cart';

    public function getCart()
    {
        return session()->get(self::CART_SESSION_KEY, []);
    }

    public function addToCart($productId, $productName, $price, $subscriptionPeriod)
    {
        $cart = $this->getCart();
        
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $productName,
                'price' => $price,
                'subscription_period' => $subscriptionPeriod,
                'quantity' => 1
            ];
        }
        
        session()->put(self::CART_SESSION_KEY, $cart);
        return $cart;
    }

    public function removeFromCart($productId)
    {
        $cart = $this->getCart();
        unset($cart[$productId]);
        session()->put(self::CART_SESSION_KEY, $cart);
        return $cart;
    }

    public function clearCart()
    {
        session()->forget(self::CART_SESSION_KEY);
    }

    public function getCartTotal()
    {
        $cart = $this->getCart();
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return $total;
    }

    public function getCartCount()
    {
        $cart = $this->getCart();
        $count = 0;
        
        foreach ($cart as $item) {
            $count += $item['quantity'];
        }
        
        return $count;
    }
}