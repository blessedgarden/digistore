@extends('layouts.admin')

@section('title', 'Добавить категорию — DigiStore')

@section('content')
<div class="min-h-screen bg-dark">
    <!-- Header -->
    <section class="bg-darkLight border-b border-primary/20 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center space-x-4">
                <a href="{{ route('admin.categories.index') }}" class="text-primary hover:text-primary/70">
                    <i class="fas fa-arrow-left text-2xl"></i>
                </a>
                <h1 class="text-4xl font-bold">Добавить категорию</h1>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-8">
            @csrf

            <div class="card p-8">
                <div class="space-y-6">
                    <!-- Name -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Название *</label>
                        <input type="text" name="name" value="{{ old('name') }}" required 
                               placeholder="Название категории">
                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Описание</label>
                        <textarea name="description" rows="4" 
                                  placeholder="Описание категории">{{ old('description') }}</textarea>
                    </div>

                    <!-- Icon -->
                    <div>
                        <label class="block text-sm font-semibold mb-2">Эмодзи или иконка</label>
                        <input type="text" name="icon" value="{{ old('icon') }}" 
                               placeholder="📦 или fa-cube">
                        <p class="text-xs text-gray-400 mt-2">Эмодзи (📦) или Font Awesome иконка (fa-cube)</p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-4">
                        <button type="submit" class="btn-primary py-3 px-8 font-bold">
                            <i class="fas fa-save mr-2"></i> Создать категорию
                        </button>
                        <a href="{{ route('admin.categories.index') }}" class="btn-secondary py-3 px-8 font-bold">
                            <i class="fas fa-times mr-2"></i> Отменить
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection