<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['product', 'user']);

        // Поиск
        if ($request->search) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            })->orWhereHas('product', function($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%");
            });
        }

        // Фильтр по рейтингу
        if ($request->rating) {
            $query->where('rating', $request->rating);
        }

        $reviews = $query->latest()->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function destroy(Review $review)
    {
        $productId = $review->product_id;
        $review->delete();

        // Обновляем рейтинг товара
        $this->updateProductRating($productId);

        return redirect()->route('admin.reviews.index')
            ->with('success', 'Отзыв удалён');
    }

    private function updateProductRating($productId)
    {
        $product = \App\Models\Product::find($productId);
        $avgRating = Review::where('product_id', $productId)->avg('rating') ?? 0;
        $reviewsCount = Review::where('product_id', $productId)->count();

        $product->update([
            'rating' => round($avgRating),
            'reviews_count' => $reviewsCount,
        ]);
    }
}