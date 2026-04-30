<nav class="bg-darkLight border-b border-primary/20 sticky top-0 z-50" x-data="{ open: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center space-x-2">
                <i class="fas fa-cube text-primary text-2xl"></i>
                <a href="{{ route('home') }}" class="text-2xl font-bold gradient-text">DigiStore</a>
            </div>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="hover:text-primary transition-colors">Главная</a>
                <a href="{{ route('catalog') }}" class="hover:text-primary transition-colors">Каталог</a>
                <a href="{{ route('about') }}" class="hover:text-primary transition-colors">О нас</a>
                <a href="{{ route('faq') }}" class="hover:text-primary transition-colors">FAQ</a>
            </div>

            <!-- Right Icons -->
            <div class="flex items-center space-x-6">
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative hover:text-primary transition-colors">
                    <i class="fas fa-shopping-cart text-xl"></i>
                    @php
                        $cartCount = \Session::get('cart') ? count(\Session::get('cart')) : 0;
                    @endphp
                    @if ($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-primary text-dark text-xs font-bold rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- Auth Menu -->
                @if (auth()->check())
                    <div class="relative" @click="open = !open">
                        <button class="flex items-center space-x-2 hover:text-primary transition-colors">
                            <i class="fas fa-user-circle text-xl"></i>
                            <span>{{ auth()->user()->name }}</span>
                        </button>

                        <!-- Dropdown Menu -->
                        <div x-show="open" @click.outside="open = false" 
                             class="absolute right-0 mt-2 w-48 bg-darkLight border border-primary/20 rounded-lg shadow-lg">
                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 hover:bg-primary/10 hover:text-primary">
                                <i class="fas fa-user mr-2"></i> Профиль
                            </a>
                            <a href="{{ route('profile.orders') }}" class="block px-4 py-2 hover:bg-primary/10 hover:text-primary">
                                <i class="fas fa-box mr-2"></i> Мои заказы
                            </a>
                            @if (auth()->user()->isAdmin())
                                <hr class="border-primary/20">
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-primary/10 hover:text-primary">
                                    <i class="fas fa-crown mr-2"></i> Админ-панель
                                </a>
                            @endif
                            <hr class="border-primary/20">
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-red-900/20 hover:text-red-400">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Выход
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="btn-secondary text-sm">Вход</a>
                    <a href="{{ route('register') }}" class="btn-primary text-sm">Регистрация</a>
                @endif

                <!-- Mobile Menu Button -->
                <button @click="open = !open" class="md:hidden text-xl hover:text-primary">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="open" class="md:hidden pb-4 space-y-2">
            <a href="{{ route('home') }}" class="block px-4 py-2 hover:bg-primary/10 hover:text-primary rounded">Главная</a>
            <a href="{{ route('catalog') }}" class="block px-4 py-2 hover:bg-primary/10 hover:text-primary rounded">Каталог</a>
            <a href="#" class="block px-4 py-2 hover:bg-primary/10 hover:text-primary rounded">О нас</a>
            <a href="#" class="block px-4 py-2 hover:bg-primary/10 hover:text-primary rounded">FAQ</a>
        </div>
    </div>
</nav>