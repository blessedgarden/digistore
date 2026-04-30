@extends('layouts.auth')

@section('title', 'Вход в аккаунт — DigiStore')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-dark via-darkLight to-dark flex items-center justify-center px-4">
    <!-- Background Animation -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-0 right-0 w-96 h-96 bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-primary/5 rounded-full blur-3xl animate-pulse" style="animation-delay: 1s;"></div>
    </div>

    <div class="w-full max-w-md relative z-10">
        <!-- Logo -->
        <div class="text-center mb-10">
            <div class="inline-flex items-center space-x-2 mb-6">
                <i class="fas fa-cube text-primary text-3xl"></i>
                <h1 class="text-3xl font-bold gradient-text">DigiStore</h1>
            </div>
            <p class="text-gray-400">Магазин цифровых подписок</p>
        </div>

        <!-- Login Form -->
        <div class="card p-8 mb-6">
            <h2 class="text-2xl font-bold mb-6 text-center">Вход в аккаунт</h2>

            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-sm font-semibold mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required 
                           placeholder="your@email.com" class="w-full">
                    @error('email')
                        <p class="text-red-400 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-semibold mb-2">Пароль</label>
                    <input type="password" name="password" required 
                           placeholder="••••••••" class="w-full">
                    @error('password')
                        <p class="text-red-400 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <label class="flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4">
                    <span class="text-sm text-gray-400">Запомнить меня</span>
                </label>

                <!-- Submit -->
                <button type="submit" class="btn-primary w-full py-3 font-bold mt-6">
                    <i class="fas fa-sign-in-alt mr-2"></i> Вход
                </button>
            </form>
        </div>

        <!-- Register Link -->
        <div class="text-center">
            <p class="text-gray-400 mb-4">
                Нет аккаунта?
                <a href="{{ route('register') }}" class="text-primary hover:underline font-semibold">
                    Зарегистрироваться
                </a>
            </p>
        </div>

        <!-- Divider -->
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-primary/20"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-dark text-gray-400">Или продолжите как гость</span>
            </div>
        </div>

        <!-- Guest Checkout -->
        <a href="{{ route('catalog') }}" class="btn-secondary w-full py-3 text-center block">
            <i class="fas fa-arrow-right mr-2"></i> Продолжить в каталог
        </a>

        <!-- Footer Links -->
        <div class="mt-8 text-center text-xs text-gray-500 space-y-2">
            <p>
                <a href="#" class="text-primary hover:underline">Условия использования</a> • 
                <a href="#" class="text-primary hover:underline">Политика конфиденциальности</a>
            </p>
        </div>
    </div>
</div>
@endsection