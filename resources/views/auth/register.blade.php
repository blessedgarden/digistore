@extends('layouts.auth')

@section('title', 'Регистрация — DigiStore')

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
            <p class="text-gray-400">Создайте аккаунт чтобы начать</p>
        </div>

        <!-- Register Form -->
        <div class="card p-8 mb-6">
            <h2 class="text-2xl font-bold mb-6 text-center">Регистрация</h2>

            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-sm font-semibold mb-2">Имя</label>
                    <input type="text" name="name" value="{{ old('name') }}" required 
                           placeholder="Ваше имя" class="w-full">
                    @error('name')
                        <p class="text-red-400 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

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
                           placeholder="Минимум 8 символов" class="w-full">
                    @error('password')
                        <p class="text-red-400 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                    <p class="text-xs text-gray-400 mt-2">
                        <i class="fas fa-info-circle mr-1"></i>
                        Пароль должен содержать заглавные буквы, цифры и быть длиной минимум 8 символов
                    </p>
                </div>

                <!-- Password Confirmation -->
                <div>
                    <label class="block text-sm font-semibold mb-2">Подтверждение пароля</label>
                    <input type="password" name="password_confirmation" required 
                           placeholder="Повторите пароль" class="w-full">
                    @error('password_confirmation')
                        <p class="text-red-400 text-sm mt-1"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                    @enderror
                </div>

                <!-- Agree Terms -->
                <label class="flex items-start space-x-2 cursor-pointer">
                    <input type="checkbox" name="agree_terms" required class="mt-1">
                    <span class="text-sm text-gray-400">
                        Я согласен с <a href="#" class="text-primary hover:underline">условиями использования</a>
                    </span>
                </label>

                <!-- Submit -->
                <button type="submit" class="btn-primary w-full py-3 font-bold mt-6">
                    <i class="fas fa-user-plus mr-2"></i> Создать аккаунт
                </button>
            </form>
        </div>

        <!-- Login Link -->
        <div class="text-center">
            <p class="text-gray-400">
                Уже есть аккаунт?
                <a href="{{ route('login') }}" class="text-primary hover:underline font-semibold">
                    Войти
                </a>
            </p>
        </div>

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