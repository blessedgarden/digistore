@extends('layouts.admin')

@section('title', 'Управление отзывами — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-4xl font-bold flex items-center space-x-3">
                <i class="fas fa-comments text-primary"></i>
                <span>Отзывы</span>
            </h1>
            <p class="text-gray-400 mt-2">Всего отзывов: <span class="text-primary font-bold">{{ $reviews->total() }}</span></p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filters -->
        <div class="card p-6 mb-8">
            <form action="{{ route('admin.reviews.index') }}" method="GET" class="flex gap-4 flex-wrap">
                <input type="text" name="search" placeholder="Поиск по пользователю или товару..."
                       value="{{ request('search') }}" class="flex-1 min-w-48">

                <select name="rating" class="min-w-32">
                    <option value="">Все оценки</option>
                    @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ request('rating') == $i ? 'selected' : '' }}>
                            {{ $i }} ★
                        </option>
                    @endfor
                </select>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-search mr-1"></i> Поиск
                </button>
            </form>
        </div>

        <!-- Reviews List -->
        <div class="space-y-4">
            @forelse($reviews as $review)
                <div class="card p-6">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <!-- Rating -->
                            <div class="flex items-center space-x-2 mb-3">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-600' }}"></i>
                                @endfor
                                <span class="text-gray-400 text-sm ml-2">{{ $review->rating }}/5</span>
                            </div>

                            <!-- Product -->
                            <div class="mb-2">
                                <span class="text-gray-400 text-sm">Товар:</span>
                                <a href="{{ route('product.show', $review->product->slug) }}" 
                                   class="text-primary hover:underline font-semibold ml-1">
                                    {{ $review->product->name }}
                                </a>
                            </div>

                            <!-- User -->
                            <div class="mb-3">
                                <span class="text-gray-400 text-sm">Пользователь:</span>
                                <span class="font-semibold ml-1">{{ $review->user->name }}</span>
                                <span class="text-gray-500 text-xs">({{ $review->user->email }})</span>
                            </div>

                            <!-- Comment -->
                            @if($review->comment)
                                <div class="bg-darkLight rounded-lg p-4 mb-2">
                                    <p class="text-gray-300">{{ $review->comment }}</p>
                                </div>
                            @endif

                            <!-- Date -->
                            <div class="text-xs text-gray-500">
                                {{ $review->created_at->format('d.m.Y H:i') }}
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="ml-4">
                            <form action="{{ route('admin.reviews.destroy', $review) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Удалить отзыв?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-400 hover:text-red-300 transition-colors">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="card p-12 text-center">
                    <i class="fas fa-inbox text-gray-600 text-4xl mb-4"></i>
                    <p class="text-gray-400">Отзывов не найдено</p>
                </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($reviews->hasPages())
            <div class="mt-8">
                {{ $reviews->links() }}
            </div>
        @endif
    </div>
</div>
@endsection