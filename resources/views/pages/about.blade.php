@extends('layouts.app')

@section('title', 'О нас — DigiStore')
@section('description', 'Узнайте больше о DigiStore — магазине цифровых подписок')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-dark via-darkLight to-dark py-24 overflow-hidden">
        <!-- Animated Background -->
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div class="inline-block bg-primary/10 border border-primary/30 rounded-full px-4 py-2 mb-6">
                    <span class="text-primary text-sm font-semibold">
                        <i class="fas fa-cube mr-2"></i>DigiStore
                    </span>
                </div>
                <h1 class="text-5xl lg:text-7xl font-bold mb-6">
                    О <span class="gradient-text">нас</span>
                </h1>
                <p class="text-gray-400 text-xl max-w-3xl mx-auto leading-relaxed">
                    Мы — команда энтузиастов, создавших лучший магазин цифровых подписок в России.
                    Наша миссия — сделать доступ к лучшим сервисам простым и доступным для каждого.
                </p>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div>
                    <h2 class="text-4xl font-bold mb-6">
                        Наша <span class="gradient-text">миссия</span>
                    </h2>
                    <p class="text-gray-400 text-lg mb-6 leading-relaxed">
                        DigiStore был основан с простой идеей — сделать цифровые продукты доступными для всех.
                        Мы верим, что каждый должен иметь доступ к лучшим инструментам для работы, творчества и развлечений.
                    </p>
                    <p class="text-gray-400 text-lg mb-8 leading-relaxed">
                        С 2024 года мы помогаем тысячам пользователей получать доступ к нейросетям, 
                        игровым сервисам, VPN и другим цифровым продуктам по выгодным ценам.
                    </p>

                    <div class="space-y-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check text-primary text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold mb-1">Мгновенная доставка</h3>
                                <p class="text-gray-400 text-sm">Получайте ключи сразу после оплаты</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check text-primary text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold mb-1">Безопасность платежей</h3>
                                <p class="text-gray-400 text-sm">SSL шифрование и защита данных</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check text-primary text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold mb-1">Поддержка 24/7</h3>
                                <p class="text-gray-400 text-sm">Наша команда всегда готова помочь</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                <i class="fas fa-check text-primary text-sm"></i>
                            </div>
                            <div>
                                <h3 class="font-bold mb-1">Гарантия качества</h3>
                                <p class="text-gray-400 text-sm">Только лицензионные ключи</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Cards -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="card p-6 text-center">
                        <i class="fas fa-users text-primary text-4xl mb-3"></i>
                        <div class="text-4xl font-bold text-primary mb-1">10K+</div>
                        <div class="text-gray-400 text-sm">Довольных клиентов</div>
                    </div>
                    <div class="card p-6 text-center">
                        <i class="fas fa-cube text-primary text-4xl mb-3"></i>
                        <div class="text-4xl font-bold text-primary mb-1">500+</div>
                        <div class="text-gray-400 text-sm">Цифровых товаров</div>
                    </div>
                    <div class="card p-6 text-center">
                        <i class="fas fa-star text-primary text-4xl mb-3"></i>
                        <div class="text-4xl font-bold text-primary mb-1">4.9</div>
                        <div class="text-gray-400 text-sm">Средняя оценка</div>
                    </div>
                    <div class="card p-6 text-center">
                        <i class="fas fa-clock text-primary text-4xl mb-3"></i>
                        <div class="text-4xl font-bold text-primary mb-1">24/7</div>
                        <div class="text-gray-400 text-sm">Поддержка клиентов</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-20 bg-darkLight/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Наши <span class="gradient-text">ценности</span></h2>
                <p class="text-gray-400 text-lg">Принципы, которыми мы руководствуемся каждый день</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="card p-8 text-center hover:border-primary group">
                    <div class="w-16 h-16 bg-primary/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/30 transition-colors">
                        <i class="fas fa-shield-alt text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Безопасность</h3>
                    <p class="text-gray-400 text-sm">Защита данных клиентов — наш главный приоритет</p>
                </div>

                <div class="card p-8 text-center hover:border-primary group">
                    <div class="w-16 h-16 bg-primary/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/30 transition-colors">
                        <i class="fas fa-handshake text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Честность</h3>
                    <p class="text-gray-400 text-sm">Прозрачные цены и честные условия сотрудничества</p>
                </div>

                <div class="card p-8 text-center hover:border-primary group">
                    <div class="w-16 h-16 bg-primary/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/30 transition-colors">
                        <i class="fas fa-rocket text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Инновации</h3>
                    <p class="text-gray-400 text-sm">Постоянное совершенствование и развитие</p>
                </div>

                <div class="card p-8 text-center hover:border-primary group">
                    <div class="w-16 h-16 bg-primary/20 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:bg-primary/30 transition-colors">
                        <i class="fas fa-heart text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Забота</h3>
                    <p class="text-gray-400 text-sm">Каждый клиент важен для нас</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Наша <span class="gradient-text">команда</span></h2>
                <p class="text-gray-400 text-lg">Люди, которые делают DigiStore лучше каждый день</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                    $team = [
                        [
                            'name' => 'Данила Лопатин',
                            'role' => 'Основатель & CEO',
                            'icon' => 'fas fa-crown',
                            'description' => '10 лет опыта в e-commerce и цифровых продуктах',
                        ],
                        [
                            'name' => 'Матвей Логинов',
                            'role' => 'Head of Operations',
                            'icon' => 'fas fa-cogs',
                            'description' => 'Эксперт по операционным процессам и клиентскому сервису',
                        ],
                        [
                            'name' => 'Тима Валяев',
                            'role' => 'Lead Developer',
                            'icon' => 'fas fa-code',
                            'description' => 'Разработчик платформы с опытом в Laravel и Vue.js',
                        ],
                    ];
                @endphp

                @foreach($team as $member)
                    <div class="card p-8 text-center hover:border-primary group">
                        <div class="w-20 h-20 bg-gradient-to-br from-primary/30 to-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:from-primary/50 group-hover:to-primary/20 transition-all">
                            <i class="{{ $member['icon'] }} text-primary text-3xl"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-1">{{ $member['name'] }}</h3>
                        <div class="text-primary text-sm font-semibold mb-4">{{ $member['role'] }}</div>
                        <p class="text-gray-400 text-sm">{{ $member['description'] }}</p>

                        <!-- Social Links -->
                        <div class="flex justify-center space-x-3 mt-6">
                            <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                                <i class="fab fa-telegram"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                                <i class="fab fa-linkedin"></i>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-primary transition-colors">
                                <i class="fab fa-github"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-20 bg-darkLight/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4">Свяжитесь с <span class="gradient-text">нами</span></h2>
                <p class="text-gray-400 text-lg">Мы всегда готовы ответить на ваши вопросы</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="card p-8 text-center hover:border-primary">
                    <div class="w-16 h-16 bg-primary/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2">Email</h3>
                    <a href="mailto:support@digistore.ru" class="text-primary hover:underline">
                        support@digistore.ru
                    </a>
                </div>

                <div class="card p-8 text-center hover:border-primary">
                    <div class="w-16 h-16 bg-primary/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fab fa-telegram text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2">Telegram</h3>
                    <a href="#" class="text-primary hover:underline">@DigiStore</a>
                </div>

                <div class="card p-8 text-center hover:border-primary">
                    <div class="w-16 h-16 bg-primary/20 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-phone text-primary text-2xl"></i>
                    </div>
                    <h3 class="font-bold mb-2">Телефон</h3>
                    <a href="tel:+79999999999" class="text-primary hover:underline">
                        +7 (999) 999-99-99
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-primary/20 to-darkLight">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-4xl font-bold mb-4">Готовы начать?</h2>
            <p class="text-gray-400 text-lg mb-8">
                Присоединяйтесь к тысячам довольных клиентов DigiStore
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('catalog') }}" class="btn-primary text-lg px-8 py-4 inline-flex items-center justify-center">
                    <i class="fas fa-shopping-bag mr-3"></i> Перейти в каталог
                </a>
                <a href="{{ route('register') }}" class="btn-secondary text-lg px-8 py-4 inline-flex items-center justify-center">
                    <i class="fas fa-user-plus mr-3"></i> Зарегистрироваться
                </a>
            </div>
        </div>
    </section>
</div>
@endsection