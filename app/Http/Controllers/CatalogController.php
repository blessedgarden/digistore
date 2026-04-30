<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        // Базовый запрос
        $query = Product::query();

        // Фильтрация по категориям
        if ($request->has('category') && $request->category !== '') {
            $category = Category::where('slug', $request->category)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        // Поиск по названию
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        // Сортировка
        $sortBy = $request->get('sort', 'latest');
        switch ($sortBy) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            case 'popular':
                $query->orderBy('reviews_count', 'desc');
                break;
            case 'rating':
                $query->orderBy('rating', 'desc');
                break;
            default:
                $query->latest();
        }

        // Фильтр по цене
        if ($request->has('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->has('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Пагинация
        $products = $query->paginate(12);

        // Получаем все категории для фильтра
        $categories = Category::all();

        // Минимальная и максимальная цена в БД
        $minPrice = Product::min('price');
        $maxPrice = Product::max('price');

        return view('catalog.index', compact(
            'products',
            'categories',
            'minPrice',
            'maxPrice',
            'sortBy'
        ));
    }
}