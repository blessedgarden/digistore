@extends('layouts.admin')

@section('title', 'Добавить товар — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.products.index') }}" class="text-primary hover:text-primary/70">
                    <i class="fas fa-arrow-left text-2xl"></i>
                </a>
                <h1 class="text-4xl font-bold">Добавить товар</h1>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            <!-- Basic Info -->
            <div class="card p-8">
                <h2 class="text-2xl font-bold mb-6">Основная информация</h2>

                <div class="space-y-4">
                    <!-- Category -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Категория *</label>
                        <select name="category_id" required class="w-full">
                            <option value="">Выберите категорию</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Название *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required 
                               placeholder="Название товара">
                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Короткое описание *</label>
                        <textarea name="description" required rows="3" 
                                  placeholder="Краткое описание товара">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Long Description -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Полное описание</label>
                        <textarea name="long_description" rows="5" 
                                  placeholder="Подробное описание товара">{{ old('long_description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- Pricing & Subscription -->
            <div class="card p-8">
                <h2 class="text-2xl font-bold mb-6">Цена и подписка</h2>

                <div class="grid grid-cols-2 gap-4">
                    <!-- Price -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Цена (₽) *</label>
                        <input type="number" name="price" value="{{ old('price') }}" required 
                               step="0.01" min="0" placeholder="0.00">
                        @error('price')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Subscription Period -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Период подписки *</label>
                        <select name="subscription_period" required>
                            @foreach ($subscriptionPeriods as $key => $label)
                                <option value="{{ $key }}" {{ old('subscription_period') == $key ? 'selected' : '' }}>
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        @error('subscription_period')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Stock -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Количество в наличии *</label>
                        <input type="number" name="stock" value="{{ old('stock', 999) }}" required 
                               min="1" placeholder="999">
                        @error('stock')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured -->
                    <div>
                        <label class="flex items-center space-x-2 cursor-pointer mt-6">
                            <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}>
                            <span class="text-sm font-semibold">Рекомендуемый товар</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Media -->
            <div class="card p-8">
                <h2 class="text-2xl font-bold mb-6">Изображение</h2>

                <div>
                    <label class="block text-sm font-semibold mb-4">Загрузить изображение</label>
                    <div class="border-2 border-dashed border-primary/30 rounded-lg p-8 text-center hover:border-primary transition-colors cursor-pointer"
                         onclick="document.getElementById('imageInput').click()">
                        <i class="fas fa-cloud-upload-alt text-primary text-4xl mb-3"></i>
                        <p class="text-gray-400">Нажмите для загрузки или перетащите файл</p>
                        <p class="text-xs text-gray-500 mt-2">PNG, JPG, GIF (максимум 2MB)</p>
                    </div>
                    <input type="file" id="imageInput" name="image" accept="image/*" class="hidden">
                    @error('image')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4">
                <button type="submit" class="btn-primary py-3 px-8 font-bold">
                    <i class="fas fa-save mr-2"></i> Создать товар
                </button>
                <a href="{{ route('admin.products.index') }}" class="btn-secondary py-3 px-8 font-bold">
                    <i class="fas fa-times mr-2"></i> Отменить
                </a>
            </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        if (e.target.files.length > 0) {
            const fileName = e.target.files[0].name;
            document.querySelector('[onclick*="imageInput"]').innerHTML = 
                `<i class="fas fa-check-circle text-green-400 text-4xl mb-3"></i><p class="text-green-400">${fileName}</p>`;
        }
    });
</script>
@endsection