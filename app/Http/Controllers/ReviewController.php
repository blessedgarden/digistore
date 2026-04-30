<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        // Проверяем авторизацию
        if (!auth()->check()) {
            return response()->json([
                'success' => false,
                'message' => 'Необходимо войти в аккаунт'
            ], 401);
        }

        $request->validate([
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $userId = auth()->id();
        $productId = $request->product_id;

        // Проверяем покупал ли пользователь этот товар
        $hasPurchased = Order::where('user_id', $userId)
            ->where('status', 'paid')
            ->whereHas('items', function($q) use ($productId) {
                $q->where('product_id', $productId);
            })->exists();

        if (!$hasPurchased) {
            return response()->json([
                'success' => false,
                'message' => 'Вы можете оставить отзыв только на купленный товар'
            ], 403);
        }

        // Проверяем не оставлял ли уже отзыв
        $existingReview = Review::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($existingReview) {
            return response()->json([
                'success' => false,
                'message' => 'Вы уже оставили отзыв на этот товар'
            ], 403);
        }

        // Создаём отзыв
        $review = Review::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Обновляем рейтинг товара
        $this->updateProductRating($productId);

        return response()->json([
            'success' => true,
            'message' => 'Отзыв успешно добавлен!',
            'review' => [
                'id' => $review->id,
                'rating' => $review->rating,
                'comment' => $review->comment,
                'user_name' => auth()->user()->name,
                'created_at' => $review->created_at->diffForHumans(),
            ]
        ]);
    }

    public function destroy(Request $request, Review $review)
    {
        // Проверяем права (только свой отзыв или админ)
        if ($review->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            return response()->json([
                'success' => false,
                'message' => 'Нет прав для удаления'
            ], 403);
        }

        $productId = $review->product_id;
        $review->delete();

        // Обновляем рейтинг товара
        $this->updateProductRating($productId);

        return response()->json([
            'success' => true,
            'message' => 'Отзыв удалён'
        ]);
    }

    private function updateProductRating($productId)
    {
        $product = Product::find($productId);
        $avgRating = Review::where('product_id', $productId)->avg('rating') ?? 0;
        $reviewsCount = Review::where('product_id', $productId)->count();

        $product->update([
            'rating' => round($avgRating),
            'reviews_count' => $reviewsCount,
        ]);
    }
}