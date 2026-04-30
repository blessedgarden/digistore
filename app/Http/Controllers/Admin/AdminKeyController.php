<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DigitalKey;
use App\Models\Product;
use App\Services\KeyService;
use Illuminate\Http\Request;

class AdminKeyController extends Controller
{
    protected $keyService;

    public function __construct(KeyService $keyService)
    {
        $this->keyService = $keyService;
    }

    public function index(Request $request)
    {
        $query = DigitalKey::with('product');

        // Фильтр по статусу
        if ($request->status) {
            $query->where('status', $request->status);
        }

        // Фильтр по товарам
        if ($request->product) {
            $query->where('product_id', $request->product);
        }

        $keys = $query->latest()->paginate(30);

        $products = Product::all();

        // Статистика
        $stats = [
            'total' => DigitalKey::count(),
            'available' => DigitalKey::where('status', 'available')->count(),
            'sold' => DigitalKey::where('status', 'sold')->count(),
            'used' => DigitalKey::where('status', 'used')->count(),
        ];

        return view('admin.keys.index', compact('keys', 'products', 'stats'));
    }

    public function generate(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
            'count' => 'required|integer|min:1|max:1000',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        // Генерируем ключи
        $this->keyService->generateKey($product->id, $validated['count']);

        return back()->with('success', "Создано {$validated['count']} ключей для товара '{$product->name}'");
    }

    public function destroy(DigitalKey $key)
    {
        // Не позволяем удалить проданные ключи
        if ($key->status === 'sold') {
            return back()->with('error', 'Нельзя удалить проданный ключ');
        }

        $key->delete();

        return back()->with('success', 'Ключ удален успешно');
    }
}