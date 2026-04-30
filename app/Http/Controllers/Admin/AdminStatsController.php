<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;

class AdminStatsController extends Controller
{
    public function index()
    {
        // Доход по месяцам
        $monthlyRevenue = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $revenue = Order::where('status', 'paid')
                ->whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->sum('total');
            
            $monthlyRevenue[$date->format('M Y')] = $revenue;
        }

        // Количество заказов по месяцам
        $monthlyOrders = [];
        for ($i = 11; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $count = Order::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $monthlyOrders[$date->format('M Y')] = $count;
        }

        // Топ товаров
        $topProducts = Product::orderBy('reviews_count', 'desc')
            ->take(10)
            ->get();

        // Средний чек
        $totalOrders = Order::where('status', 'paid')->count();
        $totalRevenue = Order::where('status', 'paid')->sum('total');
        $averageCheck = $totalOrders > 0 ? $totalRevenue / $totalOrders : 0;

        // Конверсия
        $totalUsers = User::where('role', 'user')->count();
        $usersWithOrders = User::has('orders')->count();
        $conversion = $totalUsers > 0 ? ($usersWithOrders / $totalUsers) * 100 : 0;

        // Категории по популярности
        $categoryStats = \DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, COUNT(products.id) as product_count, SUM(products.reviews_count) as total_reviews')
            ->groupBy('categories.id', 'categories.name')
            ->orderByDesc('total_reviews')
            ->get();

        return view('admin.stats', compact(
            'monthlyRevenue',
            'monthlyOrders',
            'topProducts',
            'averageCheck',
            'conversion',
            'categoryStats',
            'totalRevenue',
            'totalOrders'
        ));
    }
}