@extends('layouts.app')

@section('title', 'DigiStore - Цифровые подписки и услуги')
@section('description', 'Магазин цифровых подписок на нейросети, игровые сервисы и SaaS услуги')

@section('content')
<!-- Hero Section -->
<section class="relative min-h-screen bg-gradient-to-br from-dark via-darkLight to-dark overflow-hidden pt-20">
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="fade-in">
                <div class="inline-block bg-primary/10 border border-primary/30 rounded-full px-4 py-2 mb-6">
                    <span class="text-primary text-sm font-semibold">
                        <i class="fas fa-rocket mr-2"></i>Цифровые услуги нового поколения
                    </span>
                </div>

                <h1 class="text-5xl lg:text-7xl font-bold mb-6 leading-tight">
                    Подписки на <span class="gradient-text">нейросети</span> и сервисы
                </h1>

                <p class="text-gray-400 text-lg mb-8 max-w-xl">
                    Получите мгновенный доступ к лучшим AI инструментам, игровым сервисам и SaaS решениям. 
                    Активация в несколько кликов!
                </p>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('catalog') }}" class="btn-primary text-lg px-8 py-4 inline-flex items-center justify-center">
                        <i class="fas fa-shopping-bag mr-3"></i> Перейти в каталог
                    </a>
                    <button onclick="document.getElementById('features').scrollIntoView({behavior: 'smooth'})" 
                            class="btn-secondary text-lg px-8 py-4 inline-flex items-center justify-center">
                        <i class="fas fa-arrow-down mr-3"></i> Узнать больше
                    </button>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 mt-12">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary">{{ $stats['total_products'] }}</div>
                        <div class="text-gray-400 text-sm">Товаров</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary">{{ $stats['total_categories'] }}</div>
                        <div class="text-gray-400 text-sm">Категорий</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-primary">{{ $stats['total_reviews'] }}</div>
                        <div class="text-gray-400 text-sm">Отзывов</div>
                    </div>
                </div>
            </div>

            <!-- Right Image -->
            <div class="hidden lg:flex items-center justify-center">
                <div class="relative w-full h-96">
                    <div class="absolute inset-0 bg-gradient-to-br from-primary/20 to-primary/5 rounded-2xl blur-2xl"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="grid grid-cols-2 gap-4">
                            <div class="card text-center p-6 hover:scale-105">
                                <i class="fas fa-brain text-primary text-4xl mb-3"></i>
                                <div class="font-semibold">AI Tools</div>
                            </div>
                            <div class="card text-center p-6 hover:scale-105">
                                <i class="fas fa-gamepad text-primary text-4xl mb-3"></i>
                                <div class="font-semibold">Games</div>
                            </div>
                            <div class="card text-center p-6 hover:scale-105">
                                <i class="fas fa-chart-line text-primary text-4xl mb-3"></i>
                                <div class="font-semibold">SaaS</div>
                            </div>
                            <div class="card text-center p-6 hover:scale-105">
                                <i class="fas fa-shield-alt text-primary text-4xl mb-3"></i>
                                <div class="font-semibold">VPN</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section id="features" class="py-20 bg-darkLight/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Категории</h2>
            <p class="text-gray-400 text-lg">Выберите категорию и найдите нужный сервис</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($categories as $category)
                <a href="{{ route('catalog') }}?category={{ $category->slug }}" 
                   class="card text-center p-8 hover:border-primary">
                    <div class="text-5xl mb-4">{{ $category->icon ?? '📦' }}</div>
                    <h3 class="text-xl font-bold mb-2">{{ $category->name }}</h3>
                    <p class="text-gray-400 text-sm">{{ $category->description }}</p>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-4xl font-bold mb-2">⭐ Рекомендуемые товары</h2>
                <p class="text-gray-400">Самые популярные подписки на нашей платформе</p>
            </div>
            <a href="{{ route('catalog') }}" class="btn-secondary">Посмотреть все →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($featuredProducts as $product)
                @include('components.product-card', ['product' => $product])
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-400">Нет рекомендуемых товаров</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Top Products Section -->
<section class="py-20 bg-darkLight/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center mb-12">
            <div>
                <h2 class="text-4xl font-bold mb-2">🏆 Лучшие товары</h2>
                <p class="text-gray-400">Товары с наибольшим количеством отзывов</p>
            </div>
            <a href="{{ route('catalog') }}?sort=popular" class="btn-secondary">Посмотреть все →</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse ($topProducts as $product)
                @include('components.product-card', ['product' => $product])
            @empty
                <div class="col-span-4 text-center py-12">
                    <p class="text-gray-400">Нет товаров</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">💬 Отзывы клиентов</h2>
            <p class="text-gray-400 text-lg">Что говорят наши пользователи</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($latestReviews as $review)
                <div class="card">
                    <!-- Rating -->
                    <div class="flex items-center mb-3">
                        @for ($i = 0; $i < $review->rating; $i++)
                            <i class="fas fa-star text-yellow-400"></i>
                        @endfor
                    </div>

                    <!-- Comment -->
                    <p class="text-gray-300 mb-4">{{ $review->comment }}</p>

                    <!-- User -->
                    <div class="flex items-center pt-4 border-t border-primary/10">
                        <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-primary"></i>
                        </div>
                        <div>
                            <div class="font-semibold">{{ $review->user->name }}</div>
                            <div class="text-xs text-gray-400">{{ $review->product->name }}</div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-3 text-center py-12">
                    <p class="text-gray-400">Нет отзывов</p>
                </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Benefits Section -->
<section class="py-20 bg-darkLight/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">Почему выбирают DigiStore</h2>
            <p class="text-gray-400 text-lg">Преимущества покупок в нашем магазине</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="card text-center p-8">
                <div class="text-5xl mb-4">⚡</div>
                <h3 class="font-bold mb-2">Мгновенная активация</h3>
                <p class="text-gray-400 text-sm">Получите ключ за несколько секунд после оплаты</p>
            </div>

            <div class="card text-center p-8">
                <div class="text-5xl mb-4">🛡️</div>
                <h3 class="font-bold mb-2">Безопасность</h3>
                <p class="text-gray-400 text-sm">Защита данных на уровне банков</p>
            </div>

            <div class="card text-center p-8">
                <div class="text-5xl mb-4">💰</div>
                <h3 class="font-bold mb-2">Лучшие цены</h3>
                <p class="text-gray-400 text-sm">Наши цены самые конкурентные на рынке</p>
            </div>

            <div class="card text-center p-8">
                <div class="text-5xl mb-4">🎯</div>
                <h3 class="font-bold mb-2">Поддержка 24/7</h3>
                <p class="text-gray-400 text-sm">Наша команда всегда готова помочь</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold mb-4">❓ Часто задаваемые вопросы</h2>
            <p class="text-gray-400">Ответы на популярные вопросы о DigiStore</p>
        </div>

        <div class="space-y-4" x-data="accordion()">
            @php
                $faqs = [
                    [
                        'question' => 'Как получить доступ после покупки?',
                        'answer' => 'Сразу после оплаты вы получите email с цифровым ключом. Просто введите его в сервисе и получите полный доступ.'
                    ],
                    [
                        'question' => 'Какие способы оплаты вы принимаете?',
                        'answer' => 'Мы принимаем оплату по карте (Visa, Mastercard), через PayPal и криптовалюту.'
                    ],
                    [
                        'question' => 'Можно ли вернуть деньги?',
                        'answer' => 'Да, если товар не активирован, можно вернуть деньги в течение 3 дней.'
                    ],
                    [
                        'question' => 'Как применить промокод?',
                        'answer' => 'На странице оформления заказа есть поле для промокода. Введите код и скидка применится автоматически.'
                    ],
                ];
            @endphp

            @foreach ($faqs as $index => $faq)
                <div class="card" @click="toggle({{ $index }})">
                    <button class="w-full flex items-center justify-between p-4 focus:outline-none hover:text-primary transition-colors">
                        <span class="font-bold text-lg">{{ $faq['question'] }}</span>
                        <i class="fas fa-chevron-down transition-transform" x-bind:style="active === {{ $index }} ? 'transform: rotate(180deg)' : ''"></i>
                    </button>
                    <div x-show="active === {{ $index }}" class="px-4 pb-4 text-gray-400 border-t border-primary/10 pt-4">
                        {{ $faq['answer'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-primary/20 to-darkLight">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-4xl font-bold mb-4">Готовы начать?</h2>
        <p class="text-gray-400 text-lg mb-8">Откройте для себя лучшие цифровые сервисы прямо сейчас</p>
        <a href="{{ route('catalog') }}" class="btn-primary text-lg px-8 py-4 inline-flex items-center">
            <i class="fas fa-arrow-right mr-3"></i> Перейти в каталог
        </a>
    </div>
</section>

<script>
    function accordion() {
        return {
            active: null,
            toggle(index) {
                this.active = this.active === index ? null : index;
            }
        }
    }
</script>
@endsection