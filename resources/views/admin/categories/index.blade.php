@extends('layouts.admin')

@section('title', 'Управление категориями — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold flex items-center space-x-3">
                        <i class="fas fa-list text-primary"></i>
                        <span>Категории</span>
                    </h1>
                    <p class="text-gray-400 mt-2">Всего категорий: <span class="text-primary font-bold">{{ $categories->total() }}</span></p>
                </div>
                <a href="{{ route('admin.categories.create') }}" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i> Добавить категорию
                </a>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Categories Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @forelse ($categories as $category)
                <div class="card p-6 hover:border-primary transition-all">
                    <div class="flex justify-between items-start mb-4">
                        <div class="text-4xl">{{ $category->icon ?? '📦' }}</div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category) }}" 
                               class="text-primary hover:text-primary/70" title="Редактировать">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" 
                                  class="inline" onsubmit="return confirm('Вы уверены?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-400 hover:text-red-300">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>

                    <h3 class="text-xl font-bold mb-2">{{ $category->name }}</h3>
                    <p class="text-gray-400 text-sm mb-4">{{ $category->description }}</p>

                    <div class="text-sm text-primary font-semibold">
                        <i class="fas fa-cube mr-1"></i>
                        {{ $category->products_count }} товаров
                    </div>
                </div>
            @empty
                <div class="col-span-3 card p-12 text-center">
                    <i class="fas fa-inbox text-gray-600 text-4xl mb-4"></i>
                    <p class="text-gray-400">Категорий не найдено</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if ($categories->hasPages())
            <div class="flex justify-center">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection