@extends('layouts.app')

@section('title', 'FAQ — DigiStore')
@section('description', 'Часто задаваемые вопросы о DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-dark via-darkLight to-dark py-24 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center">
                <div class="inline-block bg-primary/10 border border-primary/30 rounded-full px-4 py-2 mb-6">
                    <span class="text-primary text-sm font-semibold">
                        <i class="fas fa-question-circle mr-2"></i>FAQ
                    </span>
                </div>
                <h1 class="text-5xl lg:text-7xl font-bold mb-6">
                    Частые <span class="gradient-text">вопросы</span>
                </h1>
                <p class="text-gray-400 text-xl max-w-3xl mx-auto leading-relaxed">
                    Нашли ответы на самые популярные вопросы о DigiStore. 
                    Не нашли что искали? Свяжитесь с нами!
                </p>
            </div>
        </div>
    </section>

    <!-- Search -->
    <section class="py-12 bg-darkLight/50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" id="faqSearch" placeholder="Поиск по вопросам..." 
                       class="w-full pl-12 !py-4 !text-lg">
            </div>
        </div>
    </section>

    <!-- FAQ Sections -->
    <section class="py-20">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            @php
                $faqSections = [
                    [
                        'title' => '🛒 Покупки и оплата',
                        'icon' => 'fas fa-shopping-cart',
                        'questions' => [
                            [
                                'q' => 'Как совершить покупку?',
                                'a' => 'Выберите товар в каталоге, нажмите "Добавить в корзину", перейдите в корзину и оформите заказ. После оплаты вы получите цифровой ключ моментально.',
                            ],
                            [
                                'q' => 'Какие способы оплаты вы принимаете?',
                                'a' => 'Мы принимаем оплату банковскими картами (Visa, Mastercard, МИР), через PayPal и криптовалюту (Bitcoin, Ethereum, USDT).',
                            ],
                            [
                                'q' => 'Безопасна ли оплата на вашем сайте?',
                                'a' => 'Да, абсолютно безопасна. Все транзакции защищены SSL шифрованием 256 бит. Мы не храним данные вашей карты.',
                            ],
                            [
                                'q' => 'Как применить промокод?',
                                'a' => 'На странице корзины введите промокод в специальное поле и нажмите кнопку применения. Скидка будет применена автоматически.',
                            ],
                            [
                                'q' => 'Можно ли купить несколько товаров сразу?',
                                'a' => 'Да, вы можете добавить несколько товаров в корзину и оплатить их одним заказом.',
                            ],
                        ],
                    ],
                    [
                        'title' => '🔑 Цифровые ключи',
                        'icon' => 'fas fa-key',
                        'questions' => [
                            [
                                'q' => 'Как быстро я получу ключ после оплаты?',
                                'a' => 'Мгновенно! Цифровой ключ выдается автоматически сразу после подтверждения оплаты. Вам не нужно ждать.',
                            ],
                            [
                                'q' => 'Куда приходит ключ?',
                                'a' => 'Ключ отображается на странице успешного заказа и отправляется на ваш email. Также его можно найти в разделе "Мои заказы".',
                            ],
                            [
                                'q' => 'Как активировать ключ?',
                                'a' => 'Скопируйте ключ и введите его на официальном сайте сервиса. Инструкции по активации обычно прилагаются к каждому товару.',
                            ],
                            [
                                'q' => 'Что делать если ключ не работает?',
                                'a' => 'Свяжитесь с нашей поддержкой через email или Telegram. Мы заменим ключ или вернем деньги в течение 24 часов.',
                            ],
                            [
                                'q' => 'На сколько устройств действует ключ?',
                                'a' => 'Количество устройств зависит от конкретного сервиса. Эта информация указана на странице товара.',
                            ],
                        ],
                    ],
                    [
                        'title' => '💰 Возвраты и гарантии',
                        'icon' => 'fas fa-undo',
                        'questions' => [
                            [
                                'q' => 'Можно ли вернуть деньги?',
                                'a' => 'Да, если ключ не был активирован, вы можете запросить возврат в течение 3 дней с момента покупки. Свяжитесь с поддержкой.',
                            ],
                            [
                                'q' => 'Что если я случайно купил не тот товар?',
                                'a' => 'Если ключ не активирован, напишите нам и мы поможем с обменом или возвратом средств.',
                            ],
                            [
                                'q' => 'Какая гарантия на товары?',
                                'a' => 'Мы гарантируем работоспособность всех ключей. Если ключ окажется недействительным, мы заменим его бесплатно.',
                            ],
                        ],
                    ],
                    [
                        'title' => '👤 Аккаунт',
                        'icon' => 'fas fa-user',
                        'questions' => [
                            [
                                'q' => 'Обязательно ли регистрироваться?',
                                'a' => 'Для оформления заказа нужна регистрация. Это позволяет отслеживать заказы и хранить историю покупок.',
                            ],
                            [
                                'q' => 'Как восстановить пароль?',
                                'a' => 'На странице входа нажмите "Забыли пароль?", введите email и следуйте инструкциям в письме.',
                            ],
                            [
                                'q' => 'Как изменить данные профиля?',
                                'a' => 'Перейдите в личный кабинет (Профиль) и нажмите "Редактировать". Вы можете изменить имя, email и пароль.',
                            ],
                            [
                                'q' => 'Где найти историю моих заказов?',
                                'a' => 'В личном кабинете перейдите в раздел "Мои заказы". Там хранится вся история покупок с ключами.',
                            ],
                        ],
                    ],
                    [
                        'title' => '🛡️ Безопасность',
                        'icon' => 'fas fa-shield-alt',
                        'questions' => [
                            [
                                'q' => 'Как вы защищаете мои данные?',
                                'a' => 'Мы используем шифрование SSL/TLS, хешируем пароли и не передаем данные третьим лицам. Ваша конфиденциальность — наш приоритет.',
                            ],
                            [
                                'q' => 'Вы храните данные моей карты?',
                                'a' => 'Нет, мы не храним данные банковских карт. Все платежи обрабатываются через защищенные платежные шлюзы.',
                            ],
                            [
                                'q' => 'Что такое двухфакторная аутентификация?',
                                'a' => 'Это дополнительный уровень защиты аккаунта. При входе требуется не только пароль, но и код из SMS или приложения.',
                            ],
                        ],
                    ],
                    [
                        'title' => '📞 Поддержка',
                        'icon' => 'fas fa-headset',
                        'questions' => [
                            [
                                'q' => 'Как связаться с поддержкой?',
                                'a' => 'Вы можете написать нам на email support@digistore.ru или в Telegram @DigiStore. Мы отвечаем в течение 1 часа.',
                            ],
                            [
                                'q' => 'Какие часы работы поддержки?',
                                'a' => 'Наша поддержка работает 24/7 без выходных. Вы всегда можете получить помощь в любое время.',
                            ],
                            [
                                'q' => 'Сколько времени занимает ответ поддержки?',
                                'a' => 'Обычно мы отвечаем в течение 30-60 минут. В пиковые часы время ответа может составлять до 2 часов.',
                            ],
                        ],
                    ],
                ];
            @endphp

            @foreach($faqSections as $sectionIndex => $section)
                <div class="mb-12 faq-section">
                    <div class="flex items-center space-x-3 mb-6">
                        <div class="w-10 h-10 bg-primary/20 rounded-lg flex items-center justify-center">
                            <i class="{{ $section['icon'] }} text-primary"></i>
                        </div>
                        <h2 class="text-2xl font-bold">{{ $section['title'] }}</h2>
                    </div>

                    <div class="space-y-3" x-data="{ active: null }">
                        @foreach($section['questions'] as $qIndex => $item)
                            <div class="card overflow-hidden faq-item">
                                <button class="w-full flex items-center justify-between p-6 text-left focus:outline-none group"
                                        @click="active = active === {{ $qIndex }} ? null : {{ $qIndex }}">
                                    <span class="font-semibold text-lg pr-4 group-hover:text-primary transition-colors faq-question">
                                        {{ $item['q'] }}
                                    </span>
                                    <div class="flex-shrink-0 w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center transition-transform"
                                         :style="active === {{ $qIndex }} ? 'transform: rotate(180deg)' : ''">
                                        <i class="fas fa-chevron-down text-primary text-sm"></i>
                                    </div>
                                </button>

                                <div x-show="active === {{ $qIndex }}"
                                     x-transition:enter="transition ease-out duration-200"
                                     x-transition:enter-start="opacity-0 transform -translate-y-2"
                                     x-transition:enter-end="opacity-100 transform translate-y-0"
                                     class="px-6 pb-6 border-t border-primary/10 pt-4">
                                    <p class="text-gray-400 leading-relaxed faq-answer">{{ $item['a'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <!-- Contact CTA -->
            <div class="card p-8 text-center bg-primary/10 border-primary/30 mt-12">
                <i class="fas fa-headset text-primary text-5xl mb-4"></i>
                <h2 class="text-2xl font-bold mb-3">Не нашли ответ на свой вопрос?</h2>
                <p class="text-gray-400 mb-6">
                    Наша команда поддержки готова помочь вам в любое время
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="mailto:support@digistore.ru" class="btn-primary inline-flex items-center justify-center px-8 py-3">
                        <i class="fas fa-envelope mr-2"></i> Написать на email
                    </a>
                    <a href="#" class="btn-secondary inline-flex items-center justify-center px-8 py-3">
                        <i class="fab fa-telegram mr-2"></i> Написать в Telegram
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    // Поиск по FAQ
    document.getElementById('faqSearch').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question').textContent.toLowerCase();
            const answer = item.querySelector('.faq-answer').textContent.toLowerCase();

            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                item.style.display = 'block';
            } else {
                item.style.display = 'none';
            }
        });

        // Скрываем пустые секции
        document.querySelectorAll('.faq-section').forEach(section => {
            const visibleItems = section.querySelectorAll('.faq-item[style="display: block"], .faq-item:not([style])');
            const hiddenItems = section.querySelectorAll('.faq-item[style="display: none;"]');
            const allItems = section.querySelectorAll('.faq-item');

            if (hiddenItems.length === allItems.length) {
                section.style.display = 'none';
            } else {
                section.style.display = 'block';
            }
        });
    });
</script>
@endsection