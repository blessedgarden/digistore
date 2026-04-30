<?php

namespace App\Services;

class PaymentService
{
    public function processPayment($orderId, $paymentMethod)
    {
        // Это заглушка. В реальном приложении здесь была бы интеграция со Stripe, PayPal и т.д.
        // Для учебного проекта просто возвращаем успех
        return [
            'success' => true,
            'transaction_id' => 'TRX-' . uniqid(),
            'method' => $paymentMethod,
        ];
    }

    public function validatePaymentDetails($cardNumber, $cvv, $expiry)
    {
        // Валидация для учебного проекта
        return strlen($cardNumber) === 16 && strlen($cvv) === 3;
    }
}