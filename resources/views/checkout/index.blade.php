@extends('layouts.app')

@section('title', 'Оформление заказа — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold flex items-center space-x-3">
                <i class="fas fa-credit-card text-primary"></i>
                <span>Оформление заказа</span>
            </h1>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <form action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- User Info -->
                    <div class="card p-8">
                        <h2 class="text-2xl font-bold mb-6 flex items-center space-x-3">
                            <i class="fas fa-user-circle text-primary"></i>
                            <span>Данные покупателя</span>
                        </h2>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold mb-2">Имя</label>
                                <input type="text" name="name" value="{{ $user->name }}" disabled 
                                       class="w-full">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold mb-2">Email</label>
                                <input type="email" name="email" value="{{ $user->email }}" disabled 
                                       class="w-full">
                            </div>
                            <p class="text-sm text-gray-400 mt-4">
                                <i class="fas fa-info-circle mr-2"></i>
                                Ключ будет отправлен на ваш email
                            </p>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="card p-8">
                        <h2 class="text-2xl font-bold mb-6 flex items-center space-x-3">
                            <i class="fas fa-wallet text-primary"></i>
                            <span>Способ оплаты</span>
                        </h2>

                        <div class="space-y-4" x-data="{ method: 'card' }">
                            <!-- Card Payment -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method" value="card" 
                                       @change="method = 'card'" checked class="sr-only peer">
                                <div class="peer-checked:bg-primary/10 peer-checked:border-primary border border-primary/30 rounded-lg p-4 flex items-center space-x-3 hover:border-primary transition-colors">
                                    <i class="fas fa-credit-card text-primary text-2xl"></i>
                                    <div>
                                        <div class="font-bold">Кредитная карта</div>
                                        <div class="text-sm text-gray-400">Visa, Mastercard</div>
                                    </div>
                                </div>
                            </label>

                            <!-- Card Details -->
                            <div x-show="method === 'card'" class="space-y-4 ml-8 mt-4">
                                <div>
                                    <label class="block text-sm font-semibold mb-2">Номер карты</label>
                                    <input type="text" name="card_number" placeholder="1234 5678 9012 3456" 
                                           maxlength="16" inputmode="numeric" class="w-full">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">Срок действия</label>
                                        <input type="text" name="card_expiry" placeholder="MM/YY" 
                                               maxlength="5" class="w-full">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-semibold mb-2">CVV</label>
                                        <input type="text" name="card_cvv" placeholder="123" 
                                               maxlength="3" inputmode="numeric" class="w-full">
                                    </div>
                                </div>
                                <div class="mt-4 p-4 bg-blue-900/20 border border-blue-700/50 rounded-lg">
                                     <p class="text-sm text-blue-400 mb-3">
                                      <i class="fas fa-info-circle mr-2"></i>
                                      Это тестовая форма. Используйте тестовые данные:
                                     </p>
                                     <button type="button" onclick="fillTestData()" 
                                      class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm">
                                       Заполнить тестовыми данными
                                         </button>
                                        </div>

<script>
function fillTestData() {
    document.querySelector('[name="card_number"]').value = '4111111111111111';
    document.querySelector('[name="card_expiry"]').value = '12/25';
    document.querySelector('[name="card_cvv"]').value = '123';
}
</script>

                                <div class="bg-yellow-900/20 border border-yellow-700/50 rounded-lg p-4">
                                    <p class="text-sm text-yellow-400">
                                        <i class="fas fa-shield-alt mr-2"></i>
                                        Ваши данные защищены 256-битным шифрованием
                                    </p>
                                </div>
                            </div>

                            <!-- PayPal -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method" value="paypal" 
                                       @change="method = 'paypal'" class="sr-only peer">
                                <div class="peer-checked:bg-primary/10 peer-checked:border-primary border border-primary/30 rounded-lg p-4 flex items-center space-x-3 hover:border-primary transition-colors">
                                    <i class="fab fa-paypal text-primary text-2xl"></i>
                                    <div>
                                        <div class="font-bold">PayPal</div>
                                        <div class="text-sm text-gray-400">Быстрая и безопасная оплата</div>
                                    </div>
                                </div>
                            </label>

                            <!-- Crypto -->
                            <label class="relative cursor-pointer">
                                <input type="radio" name="payment_method" value="crypto" 
                                       @change="method = 'crypto'" class="sr-only peer">
                                <div class="peer-checked:bg-primary/10 peer-checked:border-primary border border-primary/30 rounded-lg p-4 flex items-center space-x-3 hover:border-primary transition-colors">
                                    <i class="fas fa-bitcoin text-primary text-2xl"></i>
                                    <div>
                                        <div class="font-bold">Криптовалюта</div>
                                        <div class="text-sm text-gray-400">Bitcoin, Ethereum и другие</div>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Agree Terms -->
                    <div class="card p-6 bg-primary/5 border-primary/30">
                        <label class="flex items-start space-x-3 cursor-pointer">
                            <input type="checkbox" name="agree_terms" required class="mt-1">
                            <span class="text-sm">
                                Я согласен с <a href="#" class="text-primary hover:underline">условиями использования</a> 
                                и <a href="#" class="text-primary hover:underline">политикой конфиденциальности</a>
                            </span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn-primary w-full py-4 text-lg font-bold">
                        <i class="fas fa-lock mr-2"></i> Оплатить и получить доступ
                    </button>
                </form>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-4">
                    <!-- Order Items -->
                    <div class="card p-6">
                        <h3 class="font-bold mb-4 flex items-center space-x-2">
                            <i class="fas fa-box text-primary"></i>
                            <span>Товары в заказе</span>
                        </h3>

                        <div class="space-y-3 mb-4 pb-4 border-b border-primary/20">
                            @foreach ($cart as $item)
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="font-semibold text-sm">{{ $item['name'] }}</div>
                                        <div class="text-xs text-gray-400">{{ $item['subscription_period'] }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-primary">
                                            {{ number_format($item['price'], 0, '', ' ') }} ₽
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Subtotal -->
                        <div class="space-y-2">
                            <div class="flex justify-between text-gray-400">
                                <span>Товары:</span>
                                <span>{{ number_format($total, 0, '', ' ') }} ₽</span>
                            </div>

                            @if ($discount > 0)
                                <div class="flex justify-between text-green-400">
                                    <span>
                                        <i class="fas fa-tag mr-1"></i>
                                        Скидка
                                        @if ($promoCode)
                                            ({{ $promoCode }})
                                        @endif
                                    </span>
                                    <span>-{{ number_format($discount, 0, '', ' ') }} ₽</span>
                                </div>
                            @endif

                            <div class="flex justify-between text-gray-400">
                                <span>Доставка:</span>
                                <span>БЕСПЛАТНО</span>
                            </div>

                            <div class="flex justify-between text-gray-400">
                                <span>Комиссия:</span>
                                <span>БЕСПЛАТНО</span>
                            </div>
                        </div>

                        <!-- Total -->
                        <div class="pt-4 border-t border-primary/20 mt-4 flex justify-between items-center">
                            <span class="font-bold">Итого:</span>
                            <span class="text-2xl font-bold text-primary">
                                {{ number_format($finalTotal, 0, '', ' ') }} ₽
                            </span>
                        </div>
                    </div>

                    <!-- Security Info -->
                    <div class="card p-6">
                        <h3 class="font-bold mb-4 flex items-center space-x-2">
                            <i class="fas fa-shield-alt text-primary"></i>
                            <span>Безопасность</span>
                        </h3>

                        <div class="space-y-3 text-sm text-gray-400">
                            <div class="flex items-start space-x-2">
                                <i class="fas fa-check text-primary mt-1"></i>
                                <span>SSL шифрование 256 бит</span>
                            </div>
                            <div class="flex items-start space-x-2">
                                <i class="fas fa-check text-primary mt-1"></i>
                                <span>PCI DSS сертификация</span>
                            </div>
                            <div class="flex items-start space-x-2">
                                <i class="fas fa-check text-primary mt-1"></i>
                                <span>Защита от мошенничества</span>
                            </div>
                            <div class="flex items-start space-x-2">
                                <i class="fas fa-check text-primary mt-1"></i>
                                <span>Гарантия возврата</span>
                            </div>
                        </div>
                    </div>

                    <!-- Support -->
                    <div class="card p-6 bg-primary/10 border-primary/30">
                        <p class="text-sm mb-4">
                            <i class="fas fa-question-circle text-primary mr-2"></i>
                            Нужна помощь?
                        </p>
                        <div class="space-y-2 text-sm">
                            <p class="text-gray-400">
                                <i class="fas fa-envelope mr-2"></i>
                                <a href="mailto:support@digistore.ru" class="text-primary hover:underline">support@digistore.ru</a>
                            </p>
                            <p class="text-gray-400">
                                <i class="fas fa-phone mr-2"></i>
                                <a href="tel:+79999999999" class="text-primary hover:underline">+7 (999) 999-99-99</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Card number formatting
    document.querySelector('[name="card_number"]')?.addEventListener('input', function(e) {
        this.value = this.value.replace(/\s/g, '').replace(/(\d{4})/g, '$1 ').trim();
    });

    // Expiry date formatting
    document.querySelector('[name="card_expiry"]')?.addEventListener('input', function(e) {
        this.value = this.value.replace(/\D/g, '').replace(/(\d{2})(\d)/, '$1/$2');
    });
</script>
@endsection