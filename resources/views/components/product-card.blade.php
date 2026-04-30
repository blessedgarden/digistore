<div class="card group overflow-hidden h-full flex flex-col">
    <!-- Image Container -->
    <div class="relative overflow-hidden rounded-lg mb-4 h-48 bg-darkLight">
        @if ($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" 
                 alt="{{ $product->name }}" 
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary/20 to-darkLight">
                <i class="fas fa-cube text-primary text-5xl opacity-50"></i>
            </div>
        @endif

        <!-- Badge -->
        @if ($product->featured)
            <div class="absolute top-3 right-3 bg-primary text-dark px-3 py-1 rounded-full text-xs font-bold">
                <i class="fas fa-star mr-1"></i> Featured
            </div>
        @endif

        <!-- Rating -->
        <div class="absolute bottom-3 left-3 bg-dark/80 backdrop-blur px-3 py-1 rounded-full text-xs flex items-center space-x-1">
            <i class="fas fa-star text-yellow-400"></i>
            <span>{{ $product->rating }}</span>
        </div>
    </div>

    <!-- Content -->
    <div class="flex-1 flex flex-col">
        <!-- Category -->
        <div class="text-primary text-xs font-semibold uppercase mb-2">
            {{ $product->category->name }}
        </div>

        <!-- Title -->
        <h3 class="text-lg font-bold mb-2 line-clamp-2 group-hover:text-primary transition-colors">
            {{ $product->name }}
        </h3>

        <!-- Description -->
        <p class="text-gray-400 text-sm mb-3 line-clamp-2 flex-1">
            {{ $product->description }}
        </p>

        <!-- Info -->
        <div class="text-xs text-gray-500 mb-3 flex items-center space-x-2">
            <i class="fas fa-clock"></i>
            <span>{{ $product->subscription_period }}</span>
            <span class="mx-1">•</span>
            <i class="fas fa-comments"></i>
            <span>{{ $product->reviews_count }} отзывов</span>
        </div>

        <!-- Price & Button -->
        <div class="flex items-center justify-between pt-3 border-t border-primary/10">
            <div class="text-2xl font-bold text-primary">
                {{ number_format($product->price, 0, '', ' ') }} ₽
            </div>
            <a href="{{ route('product.show', ['product' => $product->slug]) }}" 
               class="btn-primary text-sm py-2 px-3">
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>