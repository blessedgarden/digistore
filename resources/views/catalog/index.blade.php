@extends('layouts.app')

@section('title', 'Каталог — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-3 mb-4">
                <i class="fas fa-cube text-primary text-2xl"></i>
                <h1 class="text-4xl font-bold">Каталог товаров</h1>
            </div>
            <p class="text-gray-400">Найдите нужный сервис или подписку</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Sidebar Filters -->
            <aside class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    <!-- Search -->
                    <div class="card p-6">
                        <h3 class="font-bold mb-4 flex items-center space-x-2">
                            <i class="fas fa-search text-primary"></i>
                            <span>Поиск</span>
                        </h3>
                        <form action="{{ route('catalog') }}" method="GET" id="filterForm">
                            <input type="text" name="search" placeholder="Введите название..." 
                                   value="{{ request('search') }}"
                                   class="w-full">
                        </form>
                    </div>

                    <!-- Categories Filter -->
                    <div class="card p-6">
                        <h3 class="font-bold mb-4 flex items-center space-x-2">
                            <i class="fas fa-filter text-primary"></i>
                            <span>Категории</span>
                        </h3>
                        <div class="space-y-2">
                            <a href="{{ route('catalog') }}" 
                               class="block px-3 py-2 rounded hover:bg-primary/20 hover:text-primary transition-colors {{ !request('category') ? 'bg-primary/20 text-primary' : '' }}">
                                Все категории
                            </a>
                            @foreach ($categories as $category)
                                <a href="{{ route('catalog') }}?category={{ $category->slug }}" 
                                   class="block px-3 py-2 rounded hover:bg-primary/20 hover:text-primary transition-colors {{ request('category') === $category->slug ? 'bg-primary/20 text-primary' : '' }}">
                                    {{ $category->icon ?? '📦' }} {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Filter -->
                    <div class="card p-6">
                        <h3 class="font-bold mb-4 flex items-center space-x-2">
                            <i class="fas fa-coins text-primary"></i>
                            <span>Цена</span>
                        </h3>
                        <form action="{{ route('catalog') }}" method="GET" class="space-y-4">
                            <div>
                                <label class="text-sm text-gray-400 mb-2 block">От:</label>
                                <input type="number" name="price_min" 
                                       value="{{ request('price_min', $minPrice) }}"
                                       placeholder="0"
                                       class="w-full">
                            </div>
                            <div>
                                <label class="text-sm text-gray-400 mb-2 block">До:</label>
                                <input type="number" name="price_max" 
                                       value="{{ request('price_max', $maxPrice) }}"
                                       placeholder="99999"
                                       class="w-full">
                            </div>
                            <button type="submit" class="btn-primary w-full">
                                Применить
                            </button>
                        </form>
                    </div>

                    <!-- Sort -->
                    <div class="card p-6">
                        <h3 class="font-bold mb-4 flex items-center space-x-2">
                            <i class="fas fa-sort text-primary"></i>
                            <span>Сортировка</span>
                        </h3>
                        <form action="{{ route('catalog') }}" method="GET" class="space-y-2">
                            <label class="flex items-center space-x-2 cursor-pointer hover:text-primary">
                                <input type="radio" name="sort" value="latest" 
                                       {{ $sortBy === 'latest' ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                                <span>Новые</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer hover:text-primary">
                                <input type="radio" name="sort" value="price_asc" 
                                       {{ $sortBy === 'price_asc' ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                                <span>Цена: низкая → высокая</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer hover:text-primary">
                                <input type="radio" name="sort" value="price_desc" 
                                       {{ $sortBy === 'price_desc' ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                                <span>Цена: высокая → низкая</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer hover:text-primary">
                                <input type="radio" name="sort" value="popular" 
                                       {{ $sortBy === 'popular' ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                                <span>Популярные</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer hover:text-primary">
                                <input type="radio" name="sort" value="rating" 
                                       {{ $sortBy === 'rating' ? 'checked' : '' }}
                                       onchange="this.form.submit()">
                                <span>Рейтинг</span>
                            </label>
                        </form>
                    </div>
                </div>
            </aside>

            <!-- Products Grid -->
            <div class="lg:col-span-3">
                @if ($products->count() > 0)
                    <!-- Products Count -->
                    <div class="mb-8 flex justify-between items-center">
                        <p class="text-gray-400">
                            Найдено товаров: <span class="text-primary font-bold">{{ $products->total() }}</span>
                        </p>
                    </div>

                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                        @foreach ($products as $product)
                            @include('components.product-card', ['product' => $product])
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="flex justify-center">
                        {{ $products->links() }}
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="card p-16 text-center">
                        <i class="fas fa-search text-primary text-6xl mb-4 opacity-50"></i>
                        <h3 class="text-2xl font-bold mb-2">Товары не найдены</h3>
                        <p class="text-gray-400 mb-6">
                            По вашим критериям фильтрации нет товаров. Попробуйте изменить параметры поиска.
                        </p>
                        <a href="{{ route('catalog') }}" class="btn-primary">
                            <i class="fas fa-redo mr-2"></i> Вернуться в каталог
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Custom Pagination Styling -->
<style>
    .pagination {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .pagination a, .pagination span {
        padding: 0.5rem 1rem;
        border-radius: 0.5rem;
        border: 1px solid rgba(188, 180, 255, 0.3);
        color: #ffffff;
        text-decoration: none;
        transition: all 0.3s;
    }

    .pagination a:hover {
        background-color: #BCB4FF;
        color: #222222;
        border-color: #BCB4FF;
    }

    .pagination .active span {
        background-color: #BCB4FF;
        color: #222222;
        border-color: #BCB4FF;
    }

    .pagination .disabled span {
        color: #666666;
        cursor: not-allowed;
    }
</style>
@endsection