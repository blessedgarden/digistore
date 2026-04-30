@extends('layouts.app')

@section('title', 'Заказ успешно оформлен! — DigiStore')

@section('content')
<div class="min-h-screen bg-dark py-20">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Success Animation -->
        <div class="text-center mb-12 fade-in">
            <div class="inline-flex items-center justify-center w-24 h-24 bg-green-900/30 border-2 border-green-400 rounded-full mb-6 animate-pulse">
                <i class="fas fa-check text-green-400 text-5xl"></i>
            </div>

            <h1 class="text-4xl font-bold mb-4">Заказ успешно оформлен!</h1>
            <p class="text-xl text-gray-400">Спасибо за покупку. Ваш доступ активирован.</p>
        </div>

        <!-- Order Details Card -->
        <div class="card p-8 mb-8">
            <h2 class="text-2xl font-bold mb-6 flex items-center space-x-3">
                <i class="fas fa-receipt text-primary"></i>
                <span>Детали заказа</span>
            </h2>

            <div class="space-y-4 pb-6 border-b border-primary/20">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <div class="text-gray-400 text-sm">Номер заказа:</div>
                        <div class="font-bold text-lg text-primary">{{ $order->order_number }}</div>
                    </div>
                    <div>
                        <div class="text-gray-400 text-sm">Статус:</div>
                        <div class="font-bold text-lg">
                            <span class="bg-green-900/30 text-green-400 px-3 py-1 rounded-full text-sm">
                                <i class="fas fa-check-circle mr-1"></i> Оплачено
                            </span>
                        </div>
                    </div>
                    <div>
                        <div class="text-gray-400 text-sm">Дата:</div>
                        <div class="font-semibold">{{ $order->created_at->format('d.m.Y H:i') }}</div>
                    </div>
                    <div>
                        <div class="text-gray-400 text-sm">Email:</div>
                        <div class="font-semibold">{{ $order->user->email }}</div>
                    </div>
                </div>
            </div>

            <!-- Items -->
            <div class="mb-6">
                <h3 class="font-bold mb-4">Товары в заказе:</h3>
                <div class="space-y-3">
                    @foreach ($order->items as $item)
                        <div class="flex justify-between items-start p-4 bg-darkLight rounded-lg">
                            <div>
                                <div class="font-semibold">{{ $item->product_name }}</div>
                                <div class="text-sm text-gray-400">
                                    <i class="fas fa-clock mr-1"></i>
                                    {{ $item->subscription_period }}
                                </div>
                            </div>
                            <div class="text-right">
                                <div class="text-primary font-bold">
                                    {{ number_format($item->price, 0, '', ' ') }} ₽
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Total -->
            <div class="pt-6 border-t border-primary/20">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-gray-400">Сумма:</span>
                    <span class="font-semibold">{{ number_format($order->subtotal, 0, '', ' ') }} ₽</span>
                </div>
                @if ($order->discount > 0)
                    <div class="flex justify-between items-center mb-2 text-green-400">
                        <span>Скидка:</span>
                        <span>-{{ number_format($order->discount, 0, '', ' ') }} ₽</span>
                    </div>
                @endif
                <div class="flex justify-between items-center text-lg font-bold pt-2 border-t border-primary/10">
                    <span>Итого:</span>
                    <span class="text-primary text-2xl">{{ number_format($order->total, 0, '', ' ') }} ₽</span>
                </div>
            </div>
        </div>

        <!-- Digital Keys -->
        @if (count($digitalKeys) > 0)
            <div class="card p-8 mb-8 bg-primary/10 border-primary/30">
                <h2 class="text-2xl font-bold mb-6 flex items-center space-x-3">
                    <i class="fas fa-key text-primary"></i>
                    <span>Ваши цифровые ключи</span>
                </h2>

                <div class="space-y-4">
                    @foreach ($digitalKeys as $productName => $keyValue)
                        <div class="bg-dark rounded-lg p-4 border border-primary/30">
                            <div class="flex justify-between items-start mb-3">
                                <div class="font-semibold">{{ $productName }}</div>
                                <button onclick="copyToClipboard('{{ $keyValue }}')" 
                                        class="text-primary hover:text-primary/70 transition-colors"
                                        title="Скопировать">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <div class="bg-darkLight rounded px-4 py-3 font-mono text-sm break-all select-all cursor-pointer hover:bg-darkLight/80" 
                                 onclick="copyToClipboard('{{ $keyValue }}')">
                                {{ $keyValue }}
                            </div>
                            <p class="text-xs text-gray-400 mt-2">
                                Нажмите для копирования или используйте кнопку копирования
                            </p>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 p-4 bg-blue-900/20 border border-blue-700/50 rounded-lg">
                    <p class="text-sm text-blue-400">
                        <i class="fas fa-info-circle mr-2"></i>
                        Ключи также отправлены на ваш email. Проверьте папку "Входящие" или "Спам".
                    </p>
                </div>
            </div>
        @endif

        <!-- Next Steps -->
        <div class="card p-8 mb-8">
            <h2 class="text-2xl font-bold mb-6">Что дальше?</h2>

            <div class="space-y-4">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-8 h-8 bg-primary text-dark rounded-full flex items-center justify-center font-bold">
                        1
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Проверьте Email</h3>
                        <p class="text-gray-400 text-sm">Ключи отправлены на {{ $order->user->email }}</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-8 h-8 bg-primary text-dark rounded-full flex items-center justify-center font-bold">
                        2
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Активируйте доступ</h3>
                        <p class="text-gray-400 text-sm">Введите полученный ключ на сайте сервиса</p>
                    </div>
                </div>

                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0 w-8 h-8 bg-primary text-dark rounded-full flex items-center justify-center font-bold">
                        3
                    </div>
                    <div>
                        <h3 class="font-bold mb-1">Начните использовать</h3>
                        <p class="text-gray-400 text-sm">Наслаждайтесь полным доступом к сервису</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
            <a href="{{ route('profile.orders') }}" class="btn-secondary text-center py-3">
                <i class="fas fa-history mr-2"></i> Мои заказы
            </a>
            <a href="{{ route('catalog') }}" class="btn-secondary text-center py-3">
                <i class="fas fa-shopping-bag mr-2"></i> Еще товары
            </a>
            <a href="{{ route('home') }}" class="btn-primary text-center py-3">
                <i class="fas fa-home mr-2"></i> На главную
            </a>
        </div>

        <!-- Support -->
        <div class="card p-6 text-center bg-darkLight">
            <p class="text-gray-400 mb-4">Возникли проблемы?</p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="mailto:support@digistore.ru" class="text-primary hover:underline">
                    <i class="fas fa-envelope mr-2"></i> support@digistore.ru
                </a>
                <span class="text-gray-500 hidden sm:block">•</span>
                <a href="tel:+79999999999" class="text-primary hover:underline">
                    <i class="fas fa-phone mr-2"></i> +7 (999) 999-99-99
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Ключ скопирован в буфер обмена!');
        }).catch(err => {
            console.error('Ошибка копирования:', err);
        });
    }
</script>
@endsection