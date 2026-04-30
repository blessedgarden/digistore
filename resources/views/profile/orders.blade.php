@extends('layouts.app')

@section('title', 'Мои заказы — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <h1 class="text-4xl font-bold flex items-center space-x-3">
                    <i class="fas fa-box text-primary"></i>
                    <span>Мои заказы</span>
                </h1>
                <a href="{{ route('profile.index') }}" class="btn-secondary">
                    <i class="fas fa-arrow-left mr-2"></i> Назад
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($orders->count() > 0)
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div class="card p-6 hover:border-primary transition-all">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-start">
                            <!-- Order Number -->
                            <div>
                                <div class="text-gray-400 text-sm mb-1">Номер заказа</div>
                                <div class="font-bold text-lg">{{ $order->order_number }}</div>
                            </div>

                            <!-- Date -->
                            <div>
                                <div class="text-gray-400 text-sm mb-1">Дата</div>
                                <div class="font-semibold">{{ $order->created_at->format('d.m.Y') }}</div>
                                <div class="text-gray-400 text-xs">{{ $order->created_at->format('H:i') }}</div>
                            </div>

                            <!-- Items Count -->
                            <div>
                                <div class="text-gray-400 text-sm mb-1">Товаров</div>
                                <div class="font-semibold">{{ $order->items->count() }} шт.</div>
                            </div>

                           <!-- Amount & Status -->
                            <div class="md:text-right">
                             <div class="text-2xl font-bold text-primary mb-2">
                               {{ number_format($order->total, 0, '', ' ') }} ₽
                                </div>
                                <div class="inline-block px-3 py-1 rounded-full text-sm font-semibold
                                      @if($order->status === 'paid')
                                           bg-green-900/30 text-green-400
                                             @elseif($order->status === 'pending')
                                              bg-yellow-900/30 text-yellow-400
                                                @elseif($order->status === 'completed')
                                                bg-blue-900/30 text-blue-400
                                                 @else
                                                  bg-red-900/30 text-red-400
                                                     @endif">
                                                     @if($order->status === 'paid')
                                                      ✓ Оплачено
                                                      @elseif($order->status === 'pending')
                                                       ⏳ Ожидание
                                                        @elseif($order->status === 'completed')
                                                        ✓✓ Завершено
                                                         @else
                                                         ✗ Отменено
                                                          @endif
                        </div>
                        </div>
                        </div>

                        <!-- Items Preview -->
                        <div class="mt-4 pt-4 border-t border-primary/10">
                            <div class="text-sm text-gray-400 mb-2">Товары:</div>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($order->items as $item)
                                    <span class="bg-darkLight px-3 py-1 rounded-full text-sm">
                                        {{ $item->product_name }}
                                    </span>
                                @endforeach
                            </div>
                        </div>

                        <!-- Action -->
                        <div class="mt-4 pt-4 border-t border-primary/10">
                            <a href="{{ route('profile.orders') }}" class="text-primary hover:text-primary/70 text-sm font-semibold">
                                Подробнее →
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="card p-16 text-center">
                <i class="fas fa-inbox text-primary text-6xl mb-4 opacity-50"></i>
                <h2 class="text-3xl font-bold mb-4">У вас нет заказов</h2>
                <p class="text-gray-400 mb-8">Начните покупку в нашем каталоге</p>
                <a href="{{ route('catalog') }}" class="btn-primary text-lg px-8 py-4 inline-flex items-center">
                    <i class="fas fa-shopping-bag mr-2"></i> Перейти в каталог
                </a>
            </div>
        @endif
    </div>
</div>
@endsection