@extends('layouts.app')

@section('title', $product->name . ' — DigiStore')
@section('description', $product->description)

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Breadcrumb -->
    <div class="bg-darkLight border-b border-primary/20 py-4">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-2 text-sm text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-primary">Главная</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('catalog') }}" class="hover:text-primary">Каталог</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <a href="{{ route('catalog') }}?category={{ $product->category->slug }}" class="hover:text-primary">
                    {{ $product->category->name }}
                </a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="text-primary">{{ $product->name }}</span>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
            <!-- Left: Product Image -->
            <div class="lg:col-span-1">
                <div class="card overflow-hidden mb-6 sticky top-24">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-auto rounded-lg">
                    @else
                        <div class="w-full h-80 bg-gradient-to-br from-primary/20 to-darkLight flex items-center justify-center rounded-lg">
                            <i class="fas fa-cube text-primary text-8xl opacity-30"></i>
                        </div>
                    @endif
                </div>

                <!-- Related Products -->
                @if ($relatedProducts->count() > 0)
                    <div class="card p-6">
                        <h3 class="font-bold mb-4 flex items-center space-x-2">
                            <i class="fas fa-layer-group text-primary"></i>
                            <span>Похожие товары</span>
                        </h3>
                        <div class="space-y-3">
                            @foreach ($relatedProducts as $related)
                                <a href="{{ route('product.show', ['product' => $related->slug]) }}"
                                   class="flex items-center space-x-3 p-3 rounded-lg hover:bg-primary/10 transition-colors group">
                                    <div class="w-12 h-12 bg-darkLight rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-cube text-primary text-lg"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="font-semibold truncate text-sm group-hover:text-primary transition-colors">
                                            {{ $related->name }}
                                        </div>
                                        <div class="text-primary font-bold text-sm">
                                            {{ number_format($related->price, 0, '', ' ') }} ₽
                                        </div>
                                    </div>
                                    <i class="fas fa-arrow-right text-primary opacity-0 group-hover:opacity-100 transition-opacity text-xs"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <!-- Right: Product Info -->
            <div class="lg:col-span-2">
                <!-- Badge & Category -->
                <div class="flex items-center space-x-3 mb-4">
                    <a href="{{ route('catalog') }}?category={{ $product->category->slug }}"
                       class="text-primary text-sm font-semibold uppercase hover:underline">
                        {{ $product->category->name }}
                    </a>
                    @if ($product->featured)
                        <span class="bg-primary text-dark px-3 py-1 rounded-full text-xs font-bold">
                            <i class="fas fa-star mr-1"></i> Featured
                        </span>
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $product->name }}</h1>

                <!-- Rating -->
                <div class="flex items-center space-x-4 mb-6 pb-6 border-b border-primary/20">
                    <div class="flex items-center space-x-1">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-600' }} text-lg"></i>
                        @endfor
                    </div>
                    <span class="text-primary font-bold text-lg">{{ number_format($averageRating, 1) }}</span>
                    <span class="text-gray-400">({{ $product->reviews_count }} отзывов)</span>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <p class="text-gray-300 text-lg leading-relaxed">{{ $product->description }}</p>
                    @if ($product->long_description)
                        <p class="text-gray-400 mt-4 leading-relaxed">{{ $product->long_description }}</p>
                    @endif
                </div>

                <!-- Price & Subscription Options -->
                <div class="card p-8 mb-8">
                    <h2 class="text-2xl font-bold mb-6 flex items-center space-x-2">
                        <i class="fas fa-shopping-cart text-primary"></i>
                        <span>Выберите вариант подписки</span>
                    </h2>

                    <form action="{{ route('cart.add') }}" method="POST" id="addToCartForm">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Subscription Period Selection -->
                        <div class="mb-6">
                            <label class="font-semibold mb-4 block text-gray-300">Период подписки:</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                @foreach ($subscriptionOptions as $key => $label)
                                    <label class="relative cursor-pointer">
                                        <input type="radio" name="subscription_period" value="{{ $key }}"
                                               {{ $loop->first ? 'checked' : '' }} class="sr-only peer">
                                        <div class="peer-checked:bg-primary peer-checked:text-dark peer-checked:border-primary
                                                    bg-darkLight border border-primary/30 rounded-xl p-4 text-center
                                                    hover:border-primary transition-all duration-300">
                                            <div class="font-semibold text-sm">{{ $label }}</div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Price Display -->
                        <div class="bg-darkLight rounded-xl p-6 border border-primary/20 mb-6">
                            <div class="flex justify-between items-end">
                                <div>
                                    <div class="text-gray-400 text-sm mb-1">Цена:</div>
                                    <div class="text-5xl font-bold text-primary">
                                        {{ number_format($product->price, 0, '', ' ') }} ₽
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div class="text-gray-400 text-sm mb-1">В наличии:</div>
                                    <div class="text-2xl font-bold">
                                        {{ $product->stock > 0 ? $product->stock : 'Нет' }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Add to Cart Button -->
                        <button type="submit" id="addToCartBtn"
                                class="btn-primary w-full py-4 text-lg font-bold flex items-center justify-center space-x-3">
                            <i class="fas fa-shopping-cart"></i>
                            <span>Добавить в корзину</span>
                        </button>
                    </form>

                    <!-- Features -->
                    <div class="mt-8 grid grid-cols-2 gap-3 pt-8 border-t border-primary/20">
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-bolt text-primary"></i>
                            <span>Мгновенная активация</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-key text-primary"></i>
                            <span>Лицензионный ключ</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-shield-alt text-primary"></i>
                            <span>Гарантия качества</span>
                        </div>
                        <div class="flex items-center space-x-2 text-sm">
                            <i class="fas fa-headset text-primary"></i>
                            <span>Поддержка 24/7</span>
                        </div>
                    </div>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-4 mb-8">
                    <div class="card text-center p-4 hover:border-primary">
                        <i class="fas fa-users text-primary text-2xl mb-2"></i>
                        <div class="text-2xl font-bold">{{ $product->reviews_count }}</div>
                        <div class="text-sm text-gray-400">Покупателей</div>
                    </div>
                    <div class="card text-center p-4 hover:border-primary">
                        <i class="fas fa-star text-yellow-400 text-2xl mb-2"></i>
                        <div class="text-2xl font-bold">{{ number_format($averageRating, 1) }}</div>
                        <div class="text-sm text-gray-400">Рейтинг</div>
                    </div>
                    <div class="card text-center p-4 hover:border-primary">
                        <i class="fas fa-heart text-primary text-2xl mb-2"></i>
                        <div class="text-2xl font-bold">99%</div>
                        <div class="text-sm text-gray-400">Рекомендуют</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ==================== REVIEWS SECTION ==================== -->
        <div class="mt-16">
            <h2 class="text-3xl font-bold mb-8 flex items-center space-x-3">
                <i class="fas fa-comments text-primary"></i>
                <span>Отзывы покупателей</span>
            </h2>

            <!-- Reviews Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
                <!-- Average Rating -->
                <div class="card p-8 text-center">
                    <div class="text-6xl font-bold text-primary mb-2">
                        {{ number_format($averageRating, 1) }}
                    </div>
                    <div class="flex justify-center mb-3">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="fas fa-star {{ $i <= round($averageRating) ? 'text-yellow-400' : 'text-gray-600' }} text-xl"></i>
                        @endfor
                    </div>
                    <p class="text-gray-400">{{ $product->reviews_count }} отзывов</p>
                </div>

                <!-- Rating Distribution -->
                <div class="card p-8">
                    <h3 class="font-bold mb-4">Распределение оценок</h3>
                    @foreach ($ratingDistribution as $rating => $count)
                        @php
                            $percentage = $product->reviews_count > 0
                                ? ($count / $product->reviews_count) * 100
                                : 0;
                        @endphp
                        <div class="flex items-center space-x-3 mb-3">
                            <div class="flex items-center space-x-1 w-16 flex-shrink-0">
                                <span class="text-sm font-semibold">{{ $rating }}</span>
                                <i class="fas fa-star text-yellow-400 text-xs"></i>
                            </div>
                            <div class="flex-1 bg-darkLight rounded-full h-2">
                                <div class="bg-primary h-full rounded-full transition-all duration-500"
                                     style="width: {{ $percentage }}%">
                                </div>
                            </div>
                            <span class="text-sm text-gray-400 w-8 text-right">{{ $count }}</span>
                        </div>
                    @endforeach
                </div>

                <!-- Recommendation -->
                <div class="card p-8 text-center">
                    <i class="fas fa-thumbs-up text-primary text-5xl mb-4"></i>
                    <div class="text-4xl font-bold mb-2">
                        @if($product->reviews_count > 0)
                            {{ round((($ratingDistribution[4] ?? 0) + ($ratingDistribution[5] ?? 0)) / $product->reviews_count * 100) }}%
                        @else
                            0%
                        @endif
                    </div>
                    <p class="text-gray-400">Рекомендуют товар</p>
                </div>
            </div>

            <!-- Add Review Form -->
            @auth
                @php
                    $hasPurchased = \App\Models\Order::where('user_id', auth()->id())
                        ->where('status', 'paid')
                        ->whereHas('items', fn($q) => $q->where('product_id', $product->id))
                        ->exists();

                    $hasReviewed = \App\Models\Review::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->exists();
                @endphp

                @if($hasPurchased && !$hasReviewed)
                    <div class="card p-8 mb-8 border-primary/30 bg-primary/5">
                        <h3 class="text-xl font-bold mb-6 flex items-center space-x-2">
                            <i class="fas fa-edit text-primary"></i>
                            <span>Оставить отзыв</span>
                        </h3>

                        <div id="reviewForm">
                            <!-- Star Rating -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold mb-3">Ваша оценка *</label>
                                <div class="flex space-x-2" id="starRating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <button type="button"
                                                class="star-btn text-5xl text-gray-600 hover:text-yellow-400 transition-all cursor-pointer"
                                                data-rating="{{ $i }}">
                                            ★
                                        </button>
                                    @endfor
                                </div>
                                <input type="hidden" id="selectedRating" value="0">
                                <p class="text-sm text-gray-400 mt-2" id="ratingText">Выберите оценку</p>
                            </div>

                            <!-- Comment -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold mb-2">Ваш отзыв</label>
                                <textarea id="reviewComment" rows="4"
                                          placeholder="Расскажите о своём опыте использования товара..."
                                          class="w-full resize-none"></textarea>
                                <p class="text-xs text-gray-400 mt-1">
                                    <span id="charCount">0</span>/1000 символов
                                </p>
                            </div>

                            <!-- Submit -->
                            <button id="submitReview"
                                    onclick="submitReview({{ $product->id }})"
                                    class="btn-primary px-8 py-3 font-bold">
                                <i class="fas fa-paper-plane mr-2"></i> Отправить отзыв
                            </button>
                        </div>

                        <!-- Success Message -->
                        <div id="reviewSuccess" class="hidden text-center py-8">
                            <div class="text-6xl mb-4">🎉</div>
                            <h3 class="text-xl font-bold text-green-400">Отзыв отправлен!</h3>
                            <p class="text-gray-400 mt-2">Спасибо за ваш отзыв</p>
                        </div>
                    </div>

                @elseif($hasReviewed)
                    <div class="card p-6 mb-8 bg-green-900/10 border-green-700/30">
                        <p class="text-green-400 flex items-center space-x-2">
                            <i class="fas fa-check-circle text-xl"></i>
                            <span>Вы уже оставили отзыв на этот товар</span>
                        </p>
                    </div>

                @else
                    <div class="card p-6 mb-8 bg-primary/5 border-primary/20">
                        <p class="text-gray-400 flex items-center space-x-2">
                            <i class="fas fa-info-circle text-primary text-xl"></i>
                            <span>Чтобы оставить отзыв, необходимо купить этот товар</span>
                        </p>
                    </div>
                @endif

            @else
                <div class="card p-6 mb-8 bg-primary/5 border-primary/20">
                    <p class="text-gray-400 flex items-center space-x-2">
                        <i class="fas fa-user text-primary text-xl"></i>
                        <span>
                            <a href="{{ route('login') }}" class="text-primary hover:underline font-semibold">Войдите</a>,
                            чтобы оставить отзыв
                        </span>
                    </p>
                </div>
            @endauth

            <!-- Reviews List -->
            <div id="reviewsList" class="space-y-6 mb-8">
                @forelse ($reviews as $review)
                    <div class="card p-8 fade-in" id="review-{{ $review->id }}">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary/30 to-primary/10 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-user text-primary text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">{{ $review->user->name }}</h4>
                                    <p class="text-sm text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center space-x-1">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $review->rating ? 'text-yellow-400' : 'text-gray-600' }}"></i>
                                    @endfor
                                </div>
                                @auth
                                    @if($review->user_id === auth()->id() || auth()->user()->isAdmin())
                                        <button onclick="deleteReview({{ $review->id }})"
                                                class="text-red-400 hover:text-red-300 transition-colors ml-2"
                                                title="Удалить отзыв">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    @endif
                                @endauth
                            </div>
                        </div>

                        @if ($review->comment)
                            <p class="text-gray-300 leading-relaxed">{{ $review->comment }}</p>
                        @endif

                        <div class="mt-4 flex items-center space-x-2 text-xs text-green-400">
                            <i class="fas fa-check-circle"></i>
                            <span>Подтверждённая покупка</span>
                        </div>
                    </div>
                @empty
                    <div class="card p-12 text-center" id="noReviews">
                        <i class="fas fa-comments text-gray-600 text-5xl mb-4 opacity-50"></i>
                        <p class="text-gray-400 text-lg">Пока нет отзывов. Будьте первым!</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($reviews->hasPages())
                <div class="flex justify-center">
                    {{ $reviews->links() }}
                </div>
            @endif
        </div>
    </div>
</div>

@section('scripts')
<script>
    // ==================== ADD TO CART ====================
    document.getElementById('addToCartForm').addEventListener('submit', function(e) {
        const btn = document.getElementById('addToCartBtn');
        const originalHtml = btn.innerHTML;

        btn.innerHTML = '<i class="fas fa-check mr-2"></i><span>Добавлено!</span>';
        btn.style.backgroundColor = '#10b981';
        btn.style.borderColor = '#10b981';

        setTimeout(() => {
            btn.innerHTML = originalHtml;
            btn.style.backgroundColor = '';
            btn.style.borderColor = '';
        }, 2000);
    });

    // ==================== STAR RATING ====================
    const stars = document.querySelectorAll('.star-btn');
    const ratingTexts = ['', '😞 Плохо', '😐 Нормально', '🙂 Хорошо', '😊 Очень хорошо', '🤩 Отлично!'];
    let selectedRating = 0;

    if (stars.length > 0) {
        stars.forEach(star => {
            star.addEventListener('mouseenter', function() {
                highlightStars(parseInt(this.dataset.rating));
            });

            star.addEventListener('mouseleave', function() {
                highlightStars(selectedRating);
            });

            star.addEventListener('click', function() {
                selectedRating = parseInt(this.dataset.rating);
                document.getElementById('selectedRating').value = selectedRating;
                document.getElementById('ratingText').textContent = ratingTexts[selectedRating];
                document.getElementById('ratingText').style.color = '#BCB4FF';
                highlightStars(selectedRating);
            });
        });
    }

    function highlightStars(rating) {
        stars.forEach((star, index) => {
            star.style.color = index < rating ? '#facc15' : '#4b5563';
            star.style.transform = index < rating ? 'scale(1.1)' : 'scale(1)';
        });
    }

    // Счётчик символов
    const commentBox = document.getElementById('reviewComment');
    if (commentBox) {
        commentBox.addEventListener('input', function() {
            const count = this.value.length;
            const counter = document.getElementById('charCount');
            counter.textContent = count;
            counter.style.color = count > 900 ? '#ef4444' : '';
        });
    }

    // ==================== SUBMIT REVIEW ====================
    function submitReview(productId) {
        const rating = parseInt(document.getElementById('selectedRating').value);
        const comment = document.getElementById('reviewComment').value;

        if (rating === 0) {
            showNotification('⭐ Пожалуйста, выберите оценку', 'error');
            return;
        }

        const btn = document.getElementById('submitReview');
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Отправка...';

        fetch('{{ route("reviews.store") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                product_id: productId,
                rating: rating,
                comment: comment,
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('reviewForm').classList.add('hidden');
                document.getElementById('reviewSuccess').classList.remove('hidden');

                const noReviews = document.getElementById('noReviews');
                if (noReviews) noReviews.remove();

                const stars_html = Array.from({length: 5}, (_, i) =>
                    `<i class="fas fa-star ${i < data.review.rating ? 'text-yellow-400' : 'text-gray-600'}"></i>`
                ).join('');

                const reviewHtml = `
                    <div class="card p-8 fade-in" id="review-${data.review.id}">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-primary/30 to-primary/10 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-primary text-lg"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold">${data.review.user_name}</h4>
                                    <p class="text-sm text-gray-400">${data.review.created_at}</p>
                                </div>
                            </div>
                            <div class="flex items-center space-x-1">${stars_html}</div>
                        </div>
                        ${data.review.comment ? `<p class="text-gray-300 leading-relaxed">${data.review.comment}</p>` : ''}
                        <div class="mt-4 flex items-center space-x-2 text-xs text-green-400">
                            <i class="fas fa-check-circle"></i>
                            <span>Подтверждённая покупка</span>
                        </div>
                    </div>
                `;

                document.getElementById('reviewsList').insertAdjacentHTML('afterbegin', reviewHtml);
                showNotification(data.message, 'success');
            } else {
                showNotification(data.message, 'error');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Отправить отзыв';
            }
        })
        .catch(() => {
            showNotification('Произошла ошибка. Попробуйте снова.', 'error');
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-paper-plane mr-2"></i> Отправить отзыв';
        });
    }

    // ==================== DELETE REVIEW ====================
    function deleteReview(reviewId) {
        if (!confirm('Удалить этот отзыв?')) return;

        fetch(`/reviews/${reviewId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
            }
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                const reviewEl = document.getElementById(`review-${reviewId}`);
                reviewEl.style.opacity = '0';
                reviewEl.style.transform = 'translateY(-10px)';
                reviewEl.style.transition = 'all 0.3s ease';
                setTimeout(() => reviewEl.remove(), 300);
                showNotification('Отзыв удалён', 'success');
            } else {
                showNotification(data.message, 'error');
            }
        });
    }

    // ==================== NOTIFICATIONS ====================
    function showNotification(message, type) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 z-50 px-6 py-4 rounded-xl font-semibold shadow-2xl ${
            type === 'success'
                ? 'bg-green-900/95 text-green-400 border border-green-700'
                : 'bg-red-900/95 text-red-400 border border-red-700'
        }`;
        notification.style.transition = 'all 0.3s ease';
        notification.innerHTML = `
            <div class="flex items-center space-x-3">
                <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} text-xl"></i>
                <span>${message}</span>
            </div>
        `;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
</script>
@endsection
@endsection