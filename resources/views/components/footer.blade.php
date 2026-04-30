<footer class="bg-darkLight border-t border-primary/20 mt-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- About -->
            <div>
                <div class="flex items-center space-x-2 mb-4">
                    <i class="fas fa-cube text-primary text-xl"></i>
                    <h3 class="text-lg font-bold gradient-text">DigiStore</h3>
                </div>
                <p class="text-gray-400 text-sm">
                    Магазин цифровых подписок на нейросети, игровые сервисы и SaaS услуги.
                </p>
            </div>

            <!-- Links -->
            <div>
                <h4 class="font-bold mb-4">Навигация</h4>
                <ul class="space-y-2 text-gray-400">
                    <li><a href="{{ route('home') }}" class="hover:text-primary">Главная</a></li>
                    <li><a href="{{ route('catalog') }}" class="hover:text-primary">Каталог</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-primary">О нас</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-primary">FAQ</a></li>
                    <li><a href="mailto:support@digistore.ru" class="hover:text-primary">Контакты</a></li>
                </ul>
            </div>

            <!-- Categories -->
            <div>
                <h4 class="font-bold mb-4">Категории</h4>
                <ul class="space-y-2 text-gray-400">
                    @foreach (\App\Models\Category::limit(5)->get() as $category)
                        <li>
                            <a href="{{ route('catalog') }}?category={{ $category->slug }}" class="hover:text-primary">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-bold mb-4">Контакты</h4>
                <ul class="space-y-2 text-gray-400">
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-envelope text-primary"></i>
                        <span>support@digistore.ru</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-phone text-primary"></i>
                        <span>+7 (999) 999-99-99</span>
                    </li>
                    <li class="flex items-center space-x-2">
                        <i class="fas fa-map-marker-alt text-primary"></i>
                        <span>Москва, Россия</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Social & Copyright -->
        <div class="border-t border-primary/20 pt-8 flex flex-col md:flex-row justify-between items-center">
           <div class="flex flex-col sm:flex-row items-center gap-3">
    <p class="text-gray-400 text-sm">
        &copy; 2026 DigiStore. Все права защищены.
    </p>
    <span class="hidden sm:block text-gray-600">•</span>
    <p class="text-sm flex items-center gap-2">
        <span class="text-gray-400">Дизайн и верстка сайта</span>
        <a href="https://t.me/blessedgarden" 
           target="_blank"
           class="designer-link font-bold relative inline-flex items-center gap-1 group">
            <span class="relative z-10 bg-gradient-to-r from-primary via-purple-400 to-primary bg-clip-text text-transparent"
                  style="font-family: 'Georgia', serif; font-style: italic; font-size: 1rem; letter-spacing: 0.05em;">
                by 𝒇𝒍𝒐𝒚𝒅
            </span>
            <i class="fab fa-telegram text-primary text-sm opacity-0 group-hover:opacity-100 transition-all duration-300 transform group-hover:translate-x-1"></i>
        </a>
    </p>
</div>
            <div class="flex space-x-6 mt-4 md:mt-0">
                <a href="#" class="text-gray-400 hover:text-primary">
                    <i class="fab fa-telegram text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-primary">
                    <i class="fab fa-vk text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-primary">
                    <i class="fab fa-youtube text-xl"></i>
                </a>
                <a href="#" class="text-gray-400 hover:text-primary">
                    <i class="fab fa-twitter text-xl"></i>
                </a>
            </div>
        </div>
    </div>
    <style>
    .designer-link {
        position: relative;
        transition: all 0.3s ease;
    }

    .designer-link::before {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 1px;
        background: linear-gradient(90deg, #BCB4FF, #9b8fd9);
        transition: width 0.3s ease;
    }

    .designer-link:hover::before {
        width: 100%;
    }

    .designer-link:hover {
        filter: drop-shadow(0 0 8px rgba(188, 180, 255, 0.6));
        transform: translateY(-1px);
    }

    .designer-link span {
        background-size: 200% auto;
        animation: gradientShift 3s linear infinite;
    }

    @keyframes gradientShift {
        0% { background-position: 0% center; }
        50% { background-position: 100% center; }
        100% { background-position: 0% center; }
    }
</style>
</footer>