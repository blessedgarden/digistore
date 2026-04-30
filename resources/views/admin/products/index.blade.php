@extends('layouts.admin')

@section('title', 'Управление товарами — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold flex items-center space-x-3">
                        <i class="fas fa-cube text-primary"></i>
                        <span>Товары</span>
                    </h1>
                    <p class="text-gray-400 mt-2">Всего товаров: <span class="text-primary font-bold">{{ $products->total() }}</span></p>
                </div>
                <a href="{{ route('admin.products.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i> Добавить товар
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters -->
        <div class="card p-6 mb-8">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex gap-4 flex-wrap">
                <input type="text" name="search" placeholder="Поиск по названию..." 
                       value="{{ request('search') }}" class="flex-1 min-w-48">

                <select name="category" class="min-w-48">
                    <option value="">Все категории</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-search mr-1"></i> Поиск
                </button>
            </form>
        </div>

        <!-- Products Table -->
        <div class="card overflow-hidden">
            @if ($products->count() > 0)
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Цена</th>
                            <th>Период</th>
                            <th>Статус</th>
                            <th>Отзывы</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>
                                    <div class="font-semibold">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-400">{{ Str::limit($product->description, 50) }}</div>
                                </td>
                                <td>{{ $product->category->name }}</td>
                                <td class="text-primary font-bold">{{ number_format($product->price, 0, '', ' ') }} ₽</td>
                                <td>{{ $product->subscription_period }}</td>
                                <td>
                                    @if ($product->featured)
                                        <span class="bg-primary/30 text-primary px-3 py-1 rounded-full text-sm">
                                            <i class="fas fa-star mr-1"></i> Featured
                                        </span>
                                    @else
                                        <span class="bg-gray-600/30 text-gray-400 px-3 py-1 rounded-full text-sm">
                                            Обычный
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-primary font-bold">{{ $product->reviews_count }}</span>
                                </td>
                                <td>
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.products.edit', $product) }}" 
                                           class="text-primary hover:text-primary/70" title="Редактировать">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" 
                                              class="inline" onsubmit="return confirm('Вы уверены?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="p-6 border-t border-primary/20">
                    {{ $products->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <i class="fas fa-inbox text-gray-600 text-4xl mb-4"></i>
                    <p class="text-gray-400">Товаров не найдено</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection