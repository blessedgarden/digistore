<?php

namespace App\Services;

class EmailService
{
    public function sendOrderConfirmation($user, $order)
    {
        // Заглушка для отправки email
        // В реальности здесь была бы отправка через Mail::send()
        $emailContent = "Order #{$order->order_number} confirmed!\nTotal: {$order->total}";
        
        // Просто логируем
        \Log::info("Email sent to {$user->email}: {$emailContent}");
        
        return true;
    }

    public function sendDigitalKeyEmail($user, $order)
    {
        // Отправка цифрового ключа
        $keys = [];
        foreach ($order->items as $item) {
            $key = $item->digitalKey;
            if ($key) {
                $keys[] = $key->key_value;
            }
        }

        $emailContent = "Your digital keys: " . implode(', ', $keys);
        \Log::info("Digital keys sent to {$user->email}: {$emailContent}");
        
        return true;
    }
}