@extends('layouts.admin')

@section('title', 'Управление ключами — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold flex items-center space-x-3">
                        <i class="fas fa-key text-primary"></i>
                        <span>Цифровые ключи</span>
                    </h1>
                    <p class="text-gray-400 mt-2">Управление лицензионными ключами</p>
                </div>
                <button onclick="document.getElementById('generateModal').style.display='flex'" class="btn-primary">
                    <i class="fas fa-plus mr-2"></i> Сгенерировать ключи
                </button>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="card p-6 border-t-4 border-primary">
                <div class="text-gray-400 text-sm mb-2">Всего ключей</div>
                <div class="text-3xl font-bold">{{ $stats['total'] }}</div>
            </div>
            <div class="card p-6 border-t-4 border-green-500">
                <div class="text-gray-400 text-sm mb-2">Доступных</div>
                <div class="text-3xl font-bold text-green-400">{{ $stats['available'] }}</div>
            </div>
            <div class="card p-6 border-t-4 border-blue-500">
                <div class="text-gray-400 text-sm mb-2">Продано</div>
                <div class="text-3xl font-bold text-blue-400">{{ $stats['sold'] }}</div>
            </div>
            <div class="card p-6 border-t-4 border-purple-500">
                <div class="text-gray-400 text-sm mb-2">Использовано</div>
                <div class="text-3xl font-bold text-purple-400">{{ $stats['used'] }}</div>
            </div>
        </div>

        <!-- Filters -->
        <div class="card p-6 mb-8">
            <form action="{{ route('admin.keys.index') }}" method="GET" class="flex gap-4 flex-wrap">
                <select name="product" class="min-w-48">
                    <option value="">Все товары</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" {{ request('product') == $product->id ? 'selected' : '' }}>
                            {{ $product->name }}
                        </option>
                    @endforeach
                </select>

                <select name="status" class="min-w-48">
                    <option value="">Все статусы</option>
                    <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Доступные</option>
                    <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Проданные</option>
                    <option value="used" {{ request('status') == 'used' ? 'selected' : '' }}>Использованные</option>
                </select>

                <button type="submit" class="btn-primary">
                    <i class="fas fa-search mr-1"></i> Фильтр
                </button>
            </form>
        </div>

        <!-- Keys Table -->
        <div class="card overflow-hidden">
            @if ($keys->count() > 0)
                <table class="w-full">
                    <thead>
                        <tr>
                            <th>Ключ</th>
                            <th>Товар</th>
                            <th>Статус</th>
                            <th>Дата создания</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($keys as $key)
                            <tr>
                                <td class="font-mono text-sm">{{ $key->key_value }}</td>
                                <td>{{ $key->product->name }}</td>
                                <td>
    @if($key->status === 'available')
        <span class="px-3 py-1 rounded-full text-sm font-semibold bg-green-900/30 text-green-400">
            ✓ Доступен
        </span>
    @elseif($key->status === 'sold')
        <span class="px-3 py-1 rounded-full text-sm font-semibold bg-blue-900/30 text-blue-400">
            ✓ Продан
        </span>
    @else
        <span class="px-3 py-1 rounded-full text-sm font-semibold bg-purple-900/30 text-purple-400">
            ✓ Использован
        </span>
    @endif
</td>
                                <td class="text-gray-400 text-sm">{{ $key->created_at->format('d.m.Y') }}</td>
                                <td>
                                    <form action="{{ route('admin.keys.destroy', $key) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Удалить ключ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300"
                                                {{ $key->status !== 'available' ? 'disabled' : '' }}>
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination -->
                <div class="p-6 border-t border-primary/20">
                    {{ $keys->links() }}
                </div>
            @else
                <div class="p-12 text-center">
                    <i class="fas fa-inbox text-gray-600 text-4xl mb-4"></i>
                    <p class="text-gray-400">Ключей не найдено</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Generate Modal -->
    <div id="generateModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50"
         onclick="if(event.target.id === 'generateModal') this.style.display='none'">
        <div class="card p-8 max-w-md w-full mx-4">
            <h2 class="text-2xl font-bold mb-6">Сгенерировать ключи</h2>

            <form action="{{ route('admin.keys.generate') }}" method="POST">
                @csrf

                <div class="space-y-4">
                    <!-- Product -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Товар *</label>
                        <select name="product_id" required class="w-full">
                            <option value="">Выберите товар</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Count -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Количество ключей *</label>
                        <input type="number" name="count" value="10" required min="1" max="1000">
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-3 pt-4">
                        <button type="submit" class="btn-primary flex-1 py-2">
                            <i class="fas fa-check mr-2"></i> Сгенерировать
                        </button>
                        <button type="button" onclick="document.getElementById('generateModal').style.display='none'"
                                class="btn-secondary flex-1 py-2">
                            <i class="fas fa-times mr-2"></i> Отменить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection