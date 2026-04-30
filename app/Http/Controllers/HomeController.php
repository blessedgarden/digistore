<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Review;

class HomeController extends Controller
{
    public function index()
    {
        // Получаем популярные товары (рейтинг выше 4)
        $featuredProducts = Product::where('featured', true)
            ->orderBy('rating', 'desc')
            ->take(6)
            ->get();

        // Получаем все категории
        $categories = Category::all();

        // Получаем последние отзывы
        $latestReviews = Review::with(['product', 'user'])
            ->latest()
            ->take(6)
            ->get();

        // Получаем топ товаров по продажам
        $topProducts = Product::orderBy('reviews_count', 'desc')
            ->take(8)
            ->get();

        // Статистика
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_reviews' => Review::count(),
        ];

        return view('home.index', compact(
            'featuredProducts',
            'categories',
            'latestReviews',
            'topProducts',
            'stats'
        ));
    }
}