@extends('layouts.admin')

@section('title', 'Админ-панель — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold flex items-center space-x-3">
                        <i class="fas fa-crown text-primary"></i>
                        <span>Админ-панель</span>
                    </h1>
                    <p class="text-gray-400 mt-2">Добро пожаловать, {{ auth()->user()->name }}</p>
                </div>
                <a href="{{ route('home') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> На сайт
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            <!-- Total Products -->
            <div class="card p-6 border-t-4 border-primary">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-gray-400 text-sm">Всего товаров</div>
                        <div class="text-4xl font-bold mt-2">{{ $totalProducts }}</div>
                    </div>
                    <i class="fas fa-cube text-primary text-3xl opacity-30"></i>
                </div>
            </div>

            <!-- Total Categories -->
            <div class="card p-6 border-t-4 border-primary">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-gray-400 text-sm">Категорий</div>
                        <div class="text-4xl font-bold mt-2">{{ $totalCategories }}</div>
                    </div>
                    <i class="fas fa-list text-primary text-3xl opacity-30"></i>
                </div>
            </div>

            <!-- Total Users -->
            <div class="card p-6 border-t-4 border-primary">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-gray-400 text-sm">Пользователей</div>
                        <div class="text-4xl font-bold mt-2">{{ $totalUsers }}</div>
                    </div>
                    <i class="fas fa-users text-primary text-3xl opacity-30"></i>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="card p-6 border-t-4 border-primary">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="text-gray-400 text-sm">Всего заказов</div>
                        <div class="text-4xl font-bold mt-2">{{ $totalOrders }}</div>
                    </div>
                    <i class="fas fa-shopping-bag text-primary text-3xl opacity-30"></i>
                </div>
            </div>
        </div>

        <!-- Revenue Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">
            <!-- Total Revenue -->
            <div class="card p-6 border-l-4 border-green-500">
                <div class="text-gray-400 text-sm mb-2">Общий доход</div>
                <div class="text-3xl font-bold text-green-400">
                    {{ number_format($totalRevenue, 0, '', ' ') }} ₽
                </div>
                <div class="text-xs text-gray-400 mt-2">Все время</div>
            </div>

            <!-- Monthly Revenue -->
            <div class="card p-6 border-l-4 border-blue-500">
                <div class="text-gray-400 text-sm mb-2">Доход в этом месяце</div>
                <div class="text-3xl font-bold text-blue-400">
                    {{ number_format($monthlyRevenue, 0, '', ' ') }} ₽
                </div>
                <div class="text-xs text-gray-400 mt-2">
                    @if ($monthlyRevenue > 0)
                        <span class="text-green-400">↑ +{{ number_format(($monthlyRevenue / $totalRevenue) * 100, 1) }}%</span>
                    @else
                        Нет продаж
                    @endif
                </div>
            </div>

            <!-- Average Order -->
            <div class="card p-6 border-l-4 border-purple-500">
                <div class="text-gray-400 text-sm mb-2">Средний чек</div>
                <div class="text-3xl font-bold text-purple-400">
                    {{ $totalOrders > 0 ? number_format($totalRevenue / $totalOrders, 0, '', ' ') : 0 }} ₽
                </div>
                <div class="text-xs text-gray-400 mt-2">На заказ</div>
            </div>
        </div>

        <!-- Recent Orders & Users -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
            <!-- Recent Orders -->
            <div class="card p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Последние заказы</h2>
                    <a href="{{ route('admin.orders.index') }}" class="btn-secondary text-sm">
                        Все →
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse ($recentOrders as $order)
                        <div class="p-4 bg-darkLight rounded-lg flex justify-between items-center hover:border-primary border border-primary/0 transition-all">
                            <div>
                                <div class="font-semibold">{{ $order->order_number }}</div>
                                <div class="text-sm text-gray-400">{{ $order->user->email }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-primary">{{ number_format($order->total, 0, '', ' ') }} ₽</div>
                                <span class="text-xs bg-green-900/30 text-green-400 px-2 py-1 rounded">
                                    {{ $order->status === 'paid' ? 'Оплачено' : 'Ожидание' }}
                                </span>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-center py-8">Нет заказов</p>
                    @endforelse
                </div>
            </div>

            <!-- Recent Users -->
            <div class="card p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold">Новые пользователи</h2>
                    <a href="{{ route('admin.users.index') }}" class="btn-secondary text-sm">
                        Все →
                    </a>
                </div>

                <div class="space-y-3">
                    @forelse ($recentUsers as $user)
                        <div class="p-4 bg-darkLight rounded-lg flex justify-between items-center hover:border-primary border border-primary/0 transition-all">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 bg-primary/20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-primary"></i>
                                </div>
                                <div>
                                    <div class="font-semibold">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $user->email }}</div>
                                </div>
                            </div>
                            <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    @empty
                        <p class="text-gray-400 text-center py-8">Нет пользователей</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Top Products & Order Status -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
            <!-- Top Products -->
            <div class="card p-6">
                <h2 class="text-2xl font-bold mb-6">Топ товаров</h2>

                <div class="space-y-3">
                    @forelse ($topProducts as $product)
                        <div class="flex items-center justify-between p-3 bg-darkLight rounded-lg">
                            <div>
                                <div class="font-semibold">{{ $product->name }}</div>
                                <div class="text-sm text-gray-400">{{ $product->category->name }}</div>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-primary">{{ $product->reviews_count }}</div>
                                <div class="text-xs text-gray-400">отзывов</div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-center py-8">Нет товаров</p>
                    @endforelse
                </div>
            </div>

            <!-- Order Statuses -->
            <div class="card p-6">
                <h2 class="text-2xl font-bold mb-6">Статусы заказов</h2>

                <div class="space-y-4">
                    @php
                        $statusLabels = [
                            'pending' => 'В ожидании',
                            'paid' => 'Оплачено',
                            'completed' => 'Завершено',
                            'cancelled' => 'Отменено'
                        ];
                        $statusColors = [
                            'pending' => 'yellow',
                            'paid' => 'green',
                            'completed' => 'blue',
                            'cancelled' => 'red'
                        ];
                    @endphp

                    @forelse ($orderStatuses as $status)
                        @php
                            $color = $statusColors[$status->status] ?? 'gray';
                            $total = $orderStatuses->sum('count');
                            $percentage = $total > 0 ? ($status->count / $total) * 100 : 0;
                        @endphp
                        <div>
                            <div class="flex justify-between mb-2">
                                <span>{{ $statusLabels[$status->status] }}</span>
                                <span class="font-bold">{{ $status->count }}</span>
                            </div>
                            <div class="w-full bg-darkLight rounded-full h-2">
                                <div class="bg-{{ $color }}-500 h-2 rounded-full" 
                                     style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-400 text-center py-8">Нет данных</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <a href="{{ route('admin.products.create') }}" class="card p-6 text-center hover:border-primary transition-all group">
                <i class="fas fa-plus text-primary text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="font-bold mb-1">Добавить товар</h3>
                <p class="text-sm text-gray-400">Создать новый товар</p>
            </a>

            <a href="{{ route('admin.categories.create') }}" class="card p-6 text-center hover:border-primary transition-all group">
                <i class="fas fa-folder-plus text-primary text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="font-bold mb-1">Добавить категорию</h3>
                <p class="text-sm text-gray-400">Создать новую категорию</p>
            </a>

            <a href="{{ route('admin.keys.index') }}" class="card p-6 text-center hover:border-primary transition-all group">
                <i class="fas fa-key text-primary text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="font-bold mb-1">Управлять ключами</h3>
                <p class="text-sm text-gray-400">Генерировать новые ключи</p>
            </a>

            <a href="{{ route('admin.stats') }}" class="card p-6 text-center hover:border-primary transition-all group">
                <i class="fas fa-chart-bar text-primary text-3xl mb-3 group-hover:scale-110 transition-transform"></i>
                <h3 class="font-bold mb-1">Статистика</h3>
                <p class="text-sm text-gray-400">Подробная аналитика</p>
            </a>
        </div>
    </div>
</div>
@endsection