<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Нейросети и AI',
                'description' => 'Доступ к лучшим AI инструментам',
                'icon' => '🤖',
            ],
            [
                'name' => 'Игровые сервисы',
                'description' => 'Подписки на популярные игровые платформы',
                'icon' => '🎮',
            ],
            [
                'name' => 'VPN и Безопасность',
                'description' => 'Защита вашей конфиденциальности в сети',
                'icon' => '🛡️',
            ],
            [
                'name' => 'SaaS сервисы',
                'description' => 'Облачные приложения для работы',
                'icon' => '☁️',
            ],
            [
                'name' => 'Потоковые платформы',
                'description' => 'Музыка, фильмы и сериалы',
                'icon' => '🎬',
            ],
            [
                'name' => 'Облачные хранилища',
                'description' => 'Безопасное хранение файлов',
                'icon' => '💾',
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'icon' => $category['icon'],
            ]);
        }

        echo "✓ Категории созданы\n";
    }
}