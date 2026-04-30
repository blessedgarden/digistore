@extends('layouts.admin')

@section('title', 'Статистика — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold flex items-center space-x-3">
                <i class="fas fa-chart-bar text-primary"></i>
                <span>Статистика</span>
            </h1>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Revenue Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-12">
            <div class="card p-8">
                <h2 class="text-2xl font-bold mb-6">Доход по месяцам</h2>
                <div class="space-y-4">
                    @foreach($monthlyRevenue as $month => $revenue)
                        <div class="flex justify-between items-center">
                            <span>{{ $month }}</span>
                            <span class="font-bold text-primary">{{ number_format($revenue, 0, '', ' ') }} ₽</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card p-8">
                <h2 class="text-2xl font-bold mb-6">Заказов по месяцам</h2>
                <div class="space-y-4">
                    @foreach($monthlyOrders as $month => $count)
                        <div class="flex justify-between items-center">
                            <span>{{ $month }}</span>
                            <span class="font-bold text-primary">{{ $count }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- General Stats -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">
            <div class="card p-6 text-center">
                <i class="fas fa-chart-line text-primary text-4xl mb-4"></i>
                <div class="text-3xl font-bold mb-2">{{ number_format($totalRevenue, 0, '', ' ') }} ₽</div>
                <div class="text-gray-400">Общий доход</div>
            </div>

            <div class="card p-6 text-center">
                <i class="fas fa-shopping-bag text-primary text-4xl mb-4"></i>
                <div class="text-3xl font-bold mb-2">{{ $totalOrders }}</div>
                <div class="text-gray-400">Всего заказов</div>
            </div>

            <div class="card p-6 text-center">
                <i class="fas fa-ruble-sign text-primary text-4xl mb-4"></i>
                <div class="text-3xl font-bold mb-2">{{ number_format($averageCheck, 0, '', ' ') }} ₽</div>
                <div class="text-gray-400">Средний чек</div>
            </div>
        </div>

        <!-- Top Products -->
        <div class="card p-8 mb-12">
            <h2 class="text-2xl font-bold mb-6">Топ товаров</h2>
            <div class="space-y-4">
                @foreach($topProducts as $product)
                    <div class="flex justify-between items-center p-4 bg-darkLight rounded-lg">
                        <div>
                            <div class="font-semibold">{{ $product->name }}</div>
                            <div class="text-sm text-gray-400">{{ $product->category->name }}</div>
                        </div>
                        <div class="text-right">
                            <div class="font-bold text-primary">{{ $product->reviews_count }}</div>
                            <div class="text-xs text-gray-400">отзывов</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Category Stats -->
        <div class="card p-8">
            <h2 class="text-2xl font-bold mb-6">Популярность категорий</h2>
            <div class="space-y-4">
                @foreach($categoryStats as $category)
                    <div class="flex justify-between items-center">
                        <span>{{ $category->name }}</span>
                        <div class="text-right">
                            <div class="font-bold text-primary">{{ $category->total_reviews }}</div>
                            <div class="text-xs text-gray-400">{{ $category->product_count }} товаров</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection