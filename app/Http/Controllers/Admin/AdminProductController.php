<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with('category');

        // Поиск
        if ($request->search) {
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('description', 'like', "%{$request->search}%");
        }

        // Фильтр по категориям
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(15);
        $categories = Category::all();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();

        $subscriptionPeriods = [
            '1_month' => '1 месяц',
            '3_months' => '3 месяца',
            '6_months' => '6 месяцев',
            '1_year' => '1 год',
        ];

        return view('admin.products.create', compact('categories', 'subscriptionPeriods'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'subscription_period' => 'required|string',
            'stock' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'boolean',
        ]);

        // Генерируем slug
        $validated['slug'] = Str::slug($validated['name']);

        // Загружаем изображение
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар создан успешно');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();

        $subscriptionPeriods = [
            '1_month' => '1 месяц',
            '3_months' => '3 месяца',
            '6_months' => '6 месяцев',
            '1_year' => '1 год',
        ];

        return view('admin.products.edit', compact(
            'product',
            'categories',
            'subscriptionPeriods'
        ));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'subscription_period' => 'required|string',
            'stock' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'featured' => 'boolean',
            'rating' => 'nullable|integer|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
        ]);

        // Генерируем новый slug если изменилось имя
        if ($validated['name'] !== $product->name) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Загружаем новое изображение если оно загружено
        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($product->image) {
                \Storage::disk('public')->delete($product->image);
            }

            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар обновлён успешно');
    }

    public function destroy(Product $product)
    {
        // Удаляем изображение
        if ($product->image) {
            \Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Товар удалён успешно');
    }
}