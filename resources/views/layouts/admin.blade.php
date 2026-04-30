<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Админ-панель — DigiStore')</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#BCB4FF',
                        dark: '#222222',
                        darkLight: '#333333',
                    },
                    fontFamily: {
                        montserrat: ['Montserrat', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #222222;
            color: #ffffff;
        }

        * {
            transition: all 0.3s ease;
        }

        .btn-primary {
            background-color: #BCB4FF;
            color: #222222;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            border: 2px solid #BCB4FF;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: transparent;
            color: #BCB4FF;
            box-shadow: 0 0 15px rgba(188, 180, 255, 0.5);
        }

        .btn-secondary {
            background-color: transparent;
            color: #BCB4FF;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            border: 2px solid #BCB4FF;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #BCB4FF;
            color: #222222;
            box-shadow: 0 0 15px rgba(188, 180, 255, 0.5);
        }

        .card {
            background-color: #333333;
            border-radius: 12px;
            border: 1px solid rgba(188, 180, 255, 0.2);
        }

        .card:hover {
            border-color: #BCB4FF;
            box-shadow: 0 5px 20px rgba(188, 180, 255, 0.1);
        }

        input, textarea, select {
            background-color: #333333 !important;
            border: 1px solid rgba(188, 180, 255, 0.3) !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            padding: 10px 12px !important;
            width: 100%;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #BCB4FF !important;
            outline: none;
            box-shadow: 0 0 10px rgba(188, 180, 255, 0.2) !important;
        }

        input::placeholder, textarea::placeholder {
            color: #999999;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #2a2a2a;
            color: #BCB4FF;
            font-weight: 600;
            padding: 14px 16px;
            text-align: left;
            border-bottom: 2px solid rgba(188, 180, 255, 0.3);
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        td {
            padding: 14px 16px;
            border-bottom: 1px solid rgba(188, 180, 255, 0.08);
            vertical-align: middle;
        }

        tr:hover td {
            background-color: rgba(188, 180, 255, 0.04);
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: #222222;
        }

        ::-webkit-scrollbar-thumb {
            background: #BCB4FF;
            border-radius: 3px;
        }

        /* Gradient Text */
        .gradient-text {
            background: linear-gradient(135deg, #BCB4FF, #9b8fd9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Sidebar Active */
        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            color: #cccccc;
            font-size: 0.9rem;
            margin-bottom: 4px;
        }

        .sidebar-link:hover {
            background-color: rgba(188, 180, 255, 0.1);
            color: #BCB4FF;
        }

        .sidebar-link.active {
            background-color: rgba(188, 180, 255, 0.15);
            color: #BCB4FF;
        }

        .sidebar-link i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        /* Fade In Animation */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .fade-in {
            animation: fadeIn 0.4s ease;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-dark text-white">

    <!-- Top Navigation -->
    <nav class="bg-darkLight border-b border-primary/20 sticky top-0 z-40" x-data="{ open: false }">
        <div class="px-6">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-primary/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-crown text-primary text-sm"></i>
                    </div>
                    <span class="text-lg font-bold gradient-text">DigiStore Admin</span>
                </div>

                <!-- Right Side -->
                <div class="flex items-center space-x-4">
                    <!-- Visit Site -->
                    <a href="{{ route('home') }}"
                       target="_blank"
                       class="text-gray-400 hover:text-primary text-sm flex items-center space-x-1 transition-colors">
                        <i class="fas fa-external-link-alt text-xs"></i>
                        <span>На сайт</span>
                    </a>

                    <!-- User Menu -->
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="flex items-center space-x-2 hover:text-primary transition-colors">
                            <div class="w-8 h-8 bg-primary/20 rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-primary text-sm"></i>
                            </div>
                            <span class="text-sm font-semibold">{{ auth()->user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                        </button>

                        <div x-show="open"
                             @click.outside="open = false"
                             x-transition
                             class="absolute right-0 mt-2 w-48 bg-darkLight border border-primary/20 rounded-xl shadow-2xl overflow-hidden">
                            <div class="p-3 border-b border-primary/20">
                                <div class="text-sm font-semibold">{{ auth()->user()->name }}</div>
                                <div class="text-xs text-gray-400">{{ auth()->user()->email }}</div>
                            </div>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-3 hover:bg-red-900/20 hover:text-red-400 transition-colors text-sm flex items-center space-x-2">
                                    <i class="fas fa-sign-out-alt"></i>
                                    <span>Выйти</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Layout -->
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        <aside class="w-64 bg-darkLight border-r border-primary/10 flex-shrink-0">
            <div class="p-4 h-full">
            <!-- Navigation Group: Sales -->
<div class="mb-2 mt-4">
    <p class="px-3 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">Продажи</p>

    <a href="{{ route('admin.orders.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
        <i class="fas fa-shopping-bag"></i>
        Заказы
    </a>

    <a href="{{ route('admin.users.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="fas fa-users"></i>
        Пользователи
    </a>

    <!-- ДОБАВЬ ЭТУ СТРОКУ -->
    <a href="{{ route('admin.reviews.index') }}"
       class="sidebar-link {{ request()->routeIs('admin.reviews.*') ? 'active' : '' }}">
        <i class="fas fa-comments"></i>
        Отзывы
    </a>
</div>
                <!-- Navigation Group: Main -->
                <div class="mb-2">
                    <p class="px-3 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">Главное</p>

                    <a href="{{ route('admin.dashboard') }}"
                       class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-chart-line"></i>
                        Дашборд
                    </a>

                    <a href="{{ route('admin.stats') }}"
                       class="sidebar-link {{ request()->routeIs('admin.stats') ? 'active' : '' }}">
                        <i class="fas fa-chart-bar"></i>
                        Статистика
                    </a>
                </div>

                <!-- Navigation Group: Catalog -->
                <div class="mb-2 mt-4">
                    <p class="px-3 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">Каталог</p>

                    <a href="{{ route('admin.products.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-cube"></i>
                        Товары
                    </a>

                    <a href="{{ route('admin.categories.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-list"></i>
                        Категории
                    </a>

                    <a href="{{ route('admin.keys.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.keys.*') ? 'active' : '' }}">
                        <i class="fas fa-key"></i>
                        Цифровые ключи
                    </a>
                </div>

                <!-- Navigation Group: Sales -->
                <div class="mb-2 mt-4">
                    <p class="px-3 py-2 text-xs font-bold text-gray-500 uppercase tracking-wider">Продажи</p>

                    <a href="{{ route('admin.orders.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-bag"></i>
                        Заказы
                    </a>

                    <a href="{{ route('admin.users.index') }}"
                       class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        Пользователи
                    </a>
                </div>

                <!-- Divider -->
                <div class="border-t border-primary/10 my-4"></div>

                <!-- Bottom Links -->
                <a href="{{ route('home') }}"
                   target="_blank"
                   class="sidebar-link">
                    <i class="fas fa-globe"></i>
                    Перейти на сайт
                </a>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="sidebar-link w-full text-left hover:text-red-400 hover:bg-red-900/10">
                        <i class="fas fa-sign-out-alt"></i>
                        Выйти
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-auto">
            <!-- Flash Messages -->
            @if (session('success'))
                <div class="mx-6 mt-6 bg-green-900/30 border border-green-700/50 text-green-400 px-4 py-3 rounded-lg fade-in flex justify-between items-center">
                    <span><i class="fas fa-check-circle mr-2"></i>{{ session('success') }}</span>
                    <button onclick="this.parentElement.style.display='none'" class="text-xl leading-none">&times;</button>
                </div>
            @endif

            @if (session('error'))
                <div class="mx-6 mt-6 bg-red-900/30 border border-red-700/50 text-red-400 px-4 py-3 rounded-lg fade-in flex justify-between items-center">
                    <span><i class="fas fa-exclamation-circle mr-2"></i>{{ session('error') }}</span>
                    <button onclick="this.parentElement.style.display='none'" class="text-xl leading-none">&times;</button>
                </div>
            @endif

            @if ($errors->any())
                <div class="mx-6 mt-6 bg-red-900/30 border border-red-700/50 text-red-400 px-4 py-3 rounded-lg fade-in">
                    <p class="font-bold mb-2"><i class="fas fa-exclamation-triangle mr-2"></i>Ошибки валидации:</p>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>