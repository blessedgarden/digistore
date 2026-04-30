<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        // Загружаем связанные данные
        $product->load(['category', 'digitalKeys']);

        // Получаем похожие товары (из той же категории)
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        // Получаем отзывы с пользователями
        $reviews = $product->reviews()
            ->with('user')
            ->latest()
            ->paginate(5);

        // Средняя оценка
        $averageRating = $product->reviews()->avg('rating') ?? 0;

        // Подсчет отзывов по рейтингу (от 5 до 1)
        $ratingDistribution = [];
        for ($i = 5; $i >= 1; $i--) {
            $ratingDistribution[$i] = $product->reviews()->where('rating', $i)->count();
        }

        // Получаем доступные варианты подписок
        $subscriptionOptions = [
            '1_month' => '1 месяц',
            '3_months' => '3 месяца',
            '6_months' => '6 месяцев',
            '1_year' => '1 год',
        ];

        return view('product.show', compact(
            'product',
            'relatedProducts',
            'reviews',
            'averageRating',
            'ratingDistribution',
            'subscriptionOptions'
        ));
    }
}