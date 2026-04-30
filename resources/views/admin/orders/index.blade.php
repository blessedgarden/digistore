@extends('layouts.admin')

@section('title', 'Управление заказами — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold flex items-center space-x-3">
                <i class="fas fa-shopping-bag text-primary"></i>
                <span>Заказы</span>
            </h1>
            <p class="text-gray-400 mt-2">Всего заказов: <span class="text-primary font-bold">{{ $orders->total() }}</span></p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters -->
        <div class="card p-6 mb-8">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="flex gap-4 flex-wrap">
                <input type="text" name="search" placeholder="Поиск по номеру или email..."
                       value="{{ request('search') }}" class="flex-1 min-w-48">

                <select name="status" class="min-w-48">
                    <option value="">Все статусы</option>
                    @foreach ($statuses as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-search mr-1"></i> Поиск
                </button>
            </form>
        </div>

        <!-- Orders Table -->
        <div class="card overflow-hidden">
            @if ($orders->count() > 0)
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Номер заказа</th>
                            <th>Покупатель</th>
                            <th>Дата</th>
                            <th>Сумма</th>
                            <th>Товары</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td class="font-bold text-primary">{{ $order->order_number }}</td>
                                <td>
                                    <div class="font-semibold">{{ $order->user->name }}</div>
                                    <div class="text-sm text-gray-400">{{ $order->user->email }}</div>
                                </td>
                                <td>{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                <td class="text-primary font-bold">{{ number_format($order->total, 0, '', ' ') }} ₽</td>
                                <td>
                                    <span class="bg-darkLight px-3 py-1 rounded text-sm">
                                        {{ $order->items->count() }} шт.
                                    </span>
                                </td>
                                <td>
                                    @if($order->status === 'paid')
                                        <span class="px-3 py-1 rounded text-sm font-semibold bg-green-900/30 text-green-400">
                                            {{ $statuses[$order->status] }}
                                        </span>
                                    @elseif($order->status === 'pending')
                                        <span class="px-3 py-1 rounded text-sm font-semibold bg-yellow-900/30 text-yellow-400">
                                            {{ $statuses[$order->status] }}
                                        </span>
                                    @elseif($order->status === 'completed')
                                        <span class="px-3 py-1 rounded text-sm font-semibold bg-blue-900/30 text-blue-400">
                                            {{ $statuses[$order->status] }}
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded text-sm font-semibold bg-red-900/30 text-red-400">
                                            {{ $statuses[$order->status] }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.orders.show', $order) }}"
                                       class="text-primary hover:text-primary/70" title="Просмотреть">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="p-6 border-t border-primary/20">
                    {{ $orders->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <i class="fas fa-inbox text-gray-600 text-4xl mb-4"></i>
                    <p class="text-gray-400">Заказов не найдено</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection