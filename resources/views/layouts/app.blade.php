<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DigiStore - Цифровые подписки и услуги')</title>
    <meta name="description" content="@yield('description', 'Магазин цифровых подписок на нейросети, игровые сервисы и SaaS услуги')">
    
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

        /* Плавные переходы */
        * {
            transition: all 0.3s ease;
        }

        /* Hover эффект с свечением */
        .btn-primary {
            background-color: #BCB4FF;
            color: #222222;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 12px;
            border: 2px solid #BCB4FF;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .btn-primary:hover {
            background-color: transparent;
            color: #BCB4FF;
            box-shadow: 0 0 20px rgba(188, 180, 255, 0.5);
        }

        .btn-secondary {
            background-color: transparent;
            color: #BCB4FF;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 12px;
            border: 2px solid #BCB4FF;
            cursor: pointer;
            display: inline-block;
            text-decoration: none;
        }

        .btn-secondary:hover {
            background-color: #BCB4FF;
            color: #222222;
            box-shadow: 0 0 20px rgba(188, 180, 255, 0.5);
        }

        /* Карточки */
        .card {
            background-color: #333333;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid rgba(188, 180, 255, 0.2);
            transition: all 0.3s ease;
        }

        .card:hover {
            border-color: #BCB4FF;
            box-shadow: 0 10px 40px rgba(188, 180, 255, 0.15);
            transform: translateY(-5px);
        }

        /* Градиент текста */
        .gradient-text {
            background: linear-gradient(135deg, #BCB4FF, #9b8fd9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Анимация загрузки */
        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }
            100% {
                background-position: 1000px 0;
            }
        }

        .skeleton {
            background: linear-gradient(90deg, #333333 25%, #444444 50%, #333333 75%);
            background-size: 1000px 100%;
            animation: shimmer 2s infinite;
        }

        /* Скролл стиль */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #222222;
        }

        ::-webkit-scrollbar-thumb {
            background: #BCB4FF;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #9b8fd9;
        }

        /* Input стили */
        input, textarea, select {
            background-color: #333333 !important;
            border: 1px solid rgba(188, 180, 255, 0.3) !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #BCB4FF !important;
            outline: none;
            box-shadow: 0 0 15px rgba(188, 180, 255, 0.2) !important;
        }

        input::placeholder {
            color: #999999;
        }

        /* Анимация fade-in */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease;
        }

        /* Анимация pulse */
        @keyframes pulse {
            0%, 100% {
                opacity: 1;
            }
            50% {
                opacity: 0.5;
            }
        }

        .pulse {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
    </style>
    @yield('styles')
</head>
<body class="bg-dark text-white">
    <!-- Navbar -->
    @include('components.navbar')

    <!-- Main Content -->
    <main class="min-h-screen">
        @if ($errors->any())
            <div class="max-w-7xl mx-auto mt-4 px-4">
                <div class="bg-red-900 border border-red-700 text-red-100 px-4 py-3 rounded-lg fade-in">
                    <h4 class="font-bold mb-2">Ошибка валидации:</h4>
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif

        @if (session('success'))
            <div class="max-w-7xl mx-auto mt-4 px-4">
                <div class="bg-green-900 border border-green-700 text-green-100 px-4 py-3 rounded-lg fade-in flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button onclick="this.parentElement.style.display='none'" class="text-xl">&times;</button>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div class="max-w-7xl mx-auto mt-4 px-4">
                <div class="bg-red-900 border border-red-700 text-red-100 px-4 py-3 rounded-lg fade-in flex justify-between items-center">
                    <span>{{ session('error') }}</span>
                    <button onclick="this.parentElement.style.display='none'" class="text-xl">&times;</button>
                </div>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Footer -->
    @include('components.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>