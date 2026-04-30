@extends('layouts.app')

@section('title', 'Корзина — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold flex items-center space-x-3">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span>Ваша корзина</span>
            </h1>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if (count($cart) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2">
                    <div class="space-y-4 mb-8">
                        @foreach ($cart as $productId => $item)
                            <div class="card p-6 flex flex-col md:flex-row items-start md:items-center justify-between gap-4 group" 
                                 data-product-id="{{ $productId }}">
                                <!-- Item Info -->
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold mb-2">{{ $item['name'] }}</h3>
                                    <div class="flex items-center space-x-3 text-sm text-gray-400">
                                        <span>
                                            <i class="fas fa-clock mr-1"></i>
                                            {{ $item['subscription_period'] }}
                                        </span>
                                        <span class="text-primary font-semibold">
                                            {{ number_format($item['price'], 0, '', ' ') }} ₽
                                        </span>
                                    </div>
                                </div>

                                <!-- Quantity & Price -->
                                <div class="flex items-center space-x-4">
                                    <div class="text-right">
                                        <div class="text-sm text-gray-400">Итого:</div>
                                        <div class="text-2xl font-bold text-primary">
                                            {{ number_format($item['price'] * $item['quantity'], 0, '', ' ') }} ₽
                                        </div>
                                    </div>

                                    <!-- Remove Button -->
                                    <form action="{{ route('cart.remove', ['productId' => $productId]) }}" 
                                          method="POST" class="ml-4">
                                        @csrf
                                        <button type="submit" 
                                                class="text-gray-400 hover:text-red-400 hover:bg-red-900/20 p-2 rounded-lg transition-colors"
                                                title="Удалить из корзины">
                                            <i class="fas fa-trash text-lg"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Continue Shopping -->
                    <a href="{{ route('catalog') }}" class="btn-secondary inline-flex items-center">
                        <i class="fas fa-arrow-left mr-2"></i> Продолжить покупки
                    </a>
                </div>

                <!-- Summary -->
                <div class="lg:col-span-1">
                    <div class="sticky top-24 space-y-4">
                       <!-- Promo Code -->
<div class="card p-6">
    <h3 class="font-bold mb-4 flex items-center space-x-2">
        <i class="fas fa-tag text-primary"></i>
        <span>Промокод</span>
    </h3>

    @if ($promoCode)
        <!-- Применённый промокод -->
        <div class="bg-green-900/20 border border-green-700/50 rounded-lg p-4 mb-3">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-green-400 font-bold flex items-center space-x-2">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ $promoCode }}</span>
                    </div>
                    <div class="text-sm text-gray-400 mt-1">
                        Скидка: -{{ number_format($discount, 0, '', ' ') }} ₽
                    </div>
                </div>
                <button onclick="removePromo()" 
                        class="text-red-400 hover:text-red-300 transition-colors"
                        title="Убрать промокод">
                    <i class="fas fa-times text-lg"></i>
                </button>
            </div>
        </div>
    @else
        <!-- Форма ввода промокода -->
        <div class="flex gap-2" id="promoForm">
            <input type="text" 
                   id="promoInput" 
                   placeholder="Введите промокод..." 
                   class="flex-1"
                   onkeypress="if(event.key === 'Enter') applyPromo()">
            <button onclick="applyPromo()" 
                    id="promoBtn"
                    class="btn-primary px-4 py-2 font-bold">
                Применить
            </button>
        </div>
    @endif

    <!-- Promo Message -->
    <div id="promoMessage" class="hidden mt-3 p-3 rounded-lg text-sm"></div>
</div>

                       <!-- Order Summary -->
<div class="card p-6">
    <h3 class="font-bold mb-6 text-lg flex items-center space-x-2">
        <i class="fas fa-receipt text-primary"></i>
        <span>Сумма заказа</span>
    </h3>

    <div class="space-y-3 pb-4 border-b border-primary/20" id="summaryBlock">
        <div class="flex justify-between">
            <span class="text-gray-400">Товары:</span>
            <span class="font-semibold" id="subtotalDisplay">
                {{ number_format($total, 0, '', ' ') }} ₽
            </span>
        </div>

        <div id="discountRow" class="{{ $discount > 0 ? '' : 'hidden' }} flex justify-between text-green-400">
            <span>Скидка:</span>
            <span id="discountDisplay">-{{ number_format($discount, 0, '', ' ') }} ₽</span>
        </div>

        <div class="flex justify-between text-gray-400 text-sm">
            <span>Доставка:</span>
            <span class="text-green-400 font-semibold">БЕСПЛАТНО</span>
        </div>
    </div>

    <div class="pt-4 flex justify-between items-center mb-6">
        <span class="text-lg font-bold">Итого:</span>
        <span class="text-3xl font-bold text-primary" id="totalDisplay">
            {{ number_format($finalTotal, 0, '', ' ') }} ₽
        </span>
    </div>

    @auth
        <a href="{{ route('checkout.index') }}" class="btn-primary w-full py-4 block text-center font-bold text-lg">
            <i class="fas fa-credit-card mr-2"></i> Оформить заказ
        </a>
    @else
        <a href="{{ route('login') }}" class="btn-primary w-full py-4 block text-center font-bold text-lg">
            <i class="fas fa-sign-in-alt mr-2"></i> Войти и оформить
        </a>
    @endauth
</div>

                        <!-- Info Box -->
                        <div class="card p-6 bg-primary/10 border-primary/30">
                            <div class="space-y-3 text-sm">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-check-circle text-primary mt-1"></i>
                                    <span>Мгновенная активация ключа</span>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-check-circle text-primary mt-1"></i>
                                    <span>Безопасная оплата</span>
                                </div>
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-check-circle text-primary mt-1"></i>

                                    <span>Поддержка 24/7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="card p-16 text-center max-w-2xl mx-auto">
                <i class="fas fa-shopping-cart text-primary text-6xl mb-6 opacity-50"></i>
                <h2 class="text-3xl font-bold mb-4">Ваша корзина пуста</h2>
                <p class="text-gray-400 mb-8">Добавьте товары чтобы начать покупку</p>
                <a href="{{ route('catalog') }}" class="btn-primary text-lg px-8 py-4 inline-flex items-center">
                    <i class="fas fa-arrow-right mr-2"></i> Перейти в каталог
                </a>
            </div>
        @endif
    </div>
</div>

<script>
    function applyPromo(code) {
        if (!code.trim()) {
            alert('Введите промокод');
            return;
        }

        fetch('{{ route("promo.apply") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ promo_code: code })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.message);
                location.reload();
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
@section('scripts')
<script>
    const cartSubtotal = {{ $total }};

    // Применить промокод
    function applyPromo() {
        const code = document.getElementById('promoInput')?.value?.trim();
        if (!code) {
            showPromoMessage('Введите промокод', 'error');
            return;
        }

        const btn = document.getElementById('promoBtn');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

        fetch('{{ route("promo.apply") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ promo_code: code })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                showPromoMessage(data.message, 'success');
                // Обновляем итоги
                updateTotals(data.discount, data.final_total);
                setTimeout(() => location.reload(), 1500);
            } else {
                showPromoMessage(data.message, 'error');
                btn.disabled = false;
                btn.innerHTML = 'Применить';
            }
        })
        .catch(() => {
            showPromoMessage('Ошибка. Попробуйте снова.', 'error');
            btn.disabled = false;
            btn.innerHTML = 'Применить';
        });
    }

    // Удалить промокод
    function removePromo() {
        fetch('{{ route("promo.remove") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                location.reload();
            }
        });
    }

    // Обновить итоги
    function updateTotals(discount, finalTotal) {
        if (discount > 0) {
            document.getElementById('discountRow').classList.remove('hidden');
            document.getElementById('discountDisplay').textContent = 
                '-' + Math.round(discount).toLocaleString('ru') + ' ₽';
        }
        document.getElementById('totalDisplay').textContent = 
            Math.round(finalTotal).toLocaleString('ru') + ' ₽';
    }

    // Показать сообщение промокода
    function showPromoMessage(message, type) {
        const msgEl = document.getElementById('promoMessage');
        msgEl.className = `mt-3 p-3 rounded-lg text-sm ${
            type === 'success' 
                ? 'bg-green-900/20 border border-green-700/50 text-green-400' 
                : 'bg-red-900/20 border border-red-700/50 text-red-400'
        }`;
        msgEl.innerHTML = `<i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} mr-2"></i>${message}`;
        msgEl.classList.remove('hidden');
        setTimeout(() => msgEl.classList.add('hidden'), 4000);
    }
</script>
@endsection
@endsection