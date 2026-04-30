<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Общая статистика
        $totalProducts = Product::count();
        $totalCategories = Category::count();
        $totalUsers = User::where('role', 'user')->count();
        $totalOrders = Order::count();

        // Доход
        $totalRevenue = Order::where('status', 'paid')->sum('total');
        $monthlyRevenue = Order::where('status', 'paid')
            ->where('created_at', '>=', Carbon::now()->startOfMonth())
            ->sum('total');

        // Последние заказы
        $recentOrders = Order::with(['user', 'items'])
            ->latest()
            ->take(10)
            ->get();

        // Последние пользователи
        $recentUsers = User::where('role', 'user')
            ->latest()
            ->take(10)
            ->get();

        // Популярные товары
        $topProducts = Product::orderBy('reviews_count', 'desc')
            ->take(5)
            ->get();

        // Статусы заказов
        $orderStatuses = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get();

        // График доходов за последние 30 дней
        $revenueChart = Order::where('status', 'paid')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->selectRaw('DATE(created_at) as date, SUM(total) as total')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'totalOrders',
            'totalRevenue',
            'monthlyRevenue',
            'recentOrders',
            'recentUsers',
            'topProducts',
            'orderStatuses',
            'revenueChart'
        ));
    }
}