@extends('layouts.app')

@section('title', 'Мой профиль — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold flex items-center space-x-3">
                <i class="fas fa-user-circle text-primary text-3xl"></i>
                <span>Мой профиль</span>
            </h1>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-4">
                    <!-- Profile Card -->
                    <div class="card p-8 text-center">
                        <div class="w-24 h-24 bg-gradient-to-br from-primary to-primary/50 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <i class="fas fa-user text-dark text-4xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold mb-2">{{ $user->name }}</h2>
                        <p class="text-gray-400 mb-4">{{ $user->email }}</p>
                        <div class="inline-block bg-primary/20 text-primary px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-{{ $user->role === 'admin' ? 'crown' : 'user' }} mr-1"></i>
                            {{ $user->role === 'admin' ? 'Администратор' : 'Пользователь' }}
                        </div>
                    </div>

                    <!-- Menu -->
                    <div class="card p-6 space-y-2">
                        <a href="{{ route('profile.index') }}" 
                           class="block px-4 py-3 rounded-lg bg-primary/20 text-primary">
                            <i class="fas fa-user mr-2"></i> Профиль
                        </a>
                        <a href="{{ route('profile.orders') }}" 
                           class="block px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                            <i class="fas fa-box mr-2"></i> Мои заказы
                        </a>
                        @if ($user->isAdmin())
                            <hr class="border-primary/20 my-2">
                            <a href="{{ route('admin.dashboard') }}" 
                               class="block px-4 py-3 rounded-lg hover:bg-primary/10 hover:text-primary transition-colors">
                                <i class="fas fa-crown mr-2"></i> Админ-панель
                            </a>
                        @endif
                    </div>

                    <!-- Stats -->
                    <div class="card p-6 space-y-3">
                        <h3 class="font-bold">Статистика</h3>
                        <div class="space-y-2 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-400">Всего заказов:</span>
                                <span class="font-bold text-primary">{{ $user->orders()->count() }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Потрачено:</span>
                                <span class="font-bold text-primary">
                                    {{ number_format($user->orders()->where('status', 'paid')->sum('total'), 0, '', ' ') }} ₽
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-400">Активные подписки:</span>
                                <span class="font-bold text-primary">{{ $user->orders()->where('status', 'paid')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Edit Profile -->
                <div class="card p-8">
                    <h2 class="text-2xl font-bold mb-6 flex items-center space-x-3">
                        <i class="fas fa-edit text-primary"></i>
                        <span>Редактировать профиль</span>
                    </h2>

                    <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Имя</label>
                            <input type="text" name="name" value="{{ $user->name }}" required>
                            @error('name')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold mb-2">Email</label>
                            <input type="email" name="email" value="{{ $user->email }}" required>
                            @error('email')
                                <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Change Password -->
                        <div class="pt-6 border-t border-primary/20">
                            <h3 class="font-bold mb-4">Изменить пароль</h3>

                            <div>
                                <label class="block text-sm font-semibold mb-2">Новый пароль</label>
                                <input type="password" name="password" 
                                       placeholder="Оставьте пустым, чтобы не менять">
                                @error('password')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label class="block text-sm font-semibold mb-2">Подтверждение пароля</label>
                                <input type="password" name="password_confirmation" 
                                       placeholder="Повторите пароль">
                            </div>

                            <p class="text-xs text-gray-400 mt-3">
                                <i class="fas fa-info-circle mr-1"></i>
                                Минимум 8 символов, включая заглавные буквы и цифры
                            </p>
                        </div>

                        <!-- Submit -->
                        <button type="submit" class="btn-primary py-3 px-8 font-bold">
                            <i class="fas fa-save mr-2"></i> Сохранить изменения
                        </button>
                    </form>
                </div>

                <!-- Recent Orders -->
                @if ($recentOrders->count() > 0)
                    <div class="card p-8">
                        <div class="flex justify-between items-center mb-6">
                            <h2 class="text-2xl font-bold flex items-center space-x-3">
                                <i class="fas fa-history text-primary"></i>
                                <span>Последние заказы</span>
                            </h2>
                            <a href="{{ route('profile.orders') }}" class="btn-secondary text-sm">
                                Все заказы →
                            </a>
                        </div>

                        <div class="space-y-3">
                            @foreach ($recentOrders as $order)
                                <a href="{{ route('profile.orders') }}" 
                                   class="flex items-center justify-between p-4 bg-darkLight rounded-lg hover:bg-primary/10 transition-colors">
                                    <div>
                                        <div class="font-semibold">{{ $order->order_number }}</div>
                                        <div class="text-sm text-gray-400">{{ $order->created_at->format('d.m.Y H:i') }}</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="font-bold text-primary">
                                            {{ number_format($order->total, 0, '', ' ') }} ₽
                                        </div>
                                        <div class="text-sm">
                                            <span class="px-2 py-1 rounded text-xs font-semibold
                                                {{ $order->status === 'paid' ? 'bg-green-900/30 text-green-400' : 'bg-yellow-900/30 text-yellow-400' }}">
                                                {{ $order->status === 'paid' ? 'Оплачено' : 'Ожидание' }}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Security Info -->
                <div class="card p-8 bg-primary/10 border-primary/30">
                    <h2 class="text-xl font-bold mb-4 flex items-center space-x-3">
                        <i class="fas fa-shield-alt text-primary"></i>
                        <span>Безопасность</span>
                    </h2>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check text-primary mt-1"></i>
                            <span>Ваш аккаунт защищен</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check text-primary mt-1"></i>
                            <span>Все данные зашифрованы</span>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-check text-primary mt-1"></i>
                            <span>Двухфакторная аутентификация доступна</span>
                        </div>
                    </div>
                </div>

               
            </div>
        </div>
    </div>
</div>
@endsection