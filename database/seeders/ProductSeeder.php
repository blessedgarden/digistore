<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            // Нейросети и AI
            [
                'category' => 'Нейросети и AI',
                'name' => 'ChatGPT Plus',
                'description' => 'Доступ к продвинутой версии ChatGPT с приоритетной поддержкой',
                'long_description' => 'Получите неограниченный доступ к ChatGPT Plus. Используйте передовые модели AI для написания, анализа, программирования и многого другого. Приоритетная поддержка и быстрые ответы.',
                'price' => 1990,
                'subscription_period' => '1_month',
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 234,
            ],
            [
                'category' => 'Нейросети и AI',
                'name' => 'Midjourney',
                'description' => 'Генератор изображений на основе AI',
                'long_description' => 'Создавайте уникальные изображения с помощью искусственного интеллекта. Midjourney позволяет генерировать изображения из текстовых описаний с высоким качеством.',
                'price' => 1290,
                'subscription_period' => '1_month',
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 189,
            ],
            [
                'category' => 'Нейросети и AI',
                'name' => 'Claude API',
                'description' => 'Доступ к API Claude для разработчиков',
                'long_description' => 'Интегрируйте Claude в ваши приложения. Мощный API с поддержкой различных языков и задач.',
                'price' => 2490,
                'subscription_period' => '1_month',
                'featured' => false,
                'rating' => 4,
                'reviews_count' => 156,
            ],

            // Игровые сервисы
            [
                'category' => 'Игровые сервисы',
                'name' => 'Xbox Game Pass',
                'description' => 'Доступ к сотням игр на Xbox и ПК',
                'long_description' => 'Xbox Game Pass Premium - это подписка на огромную библиотеку игр. Играйте в новые релизы в день выпуска, пользуйтесь облачными играми и многое другое.',
                'price' => 899,
                'subscription_period' => '1_month',
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 567,
            ],
            [
                'category' => 'Игровые сервисы',
                'name' => 'PlayStation Plus Premium',
                'description' => 'Премиум подписка на PlayStation Network',
                'long_description' => 'Играйте в лучшие игры PlayStation с подпиской Plus Premium. Включает доступ к классическим играм и облачным игам.',
                'price' => 1290,
                'subscription_period' => '1_month',
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 432,
            ],
            [
                'category' => 'Игровые сервисы',
                'name' => 'Nintendo Switch Online',
                'description' => 'Онлайн-подписка для Nintendo Switch',
                'long_description' => 'Играйте в онлайн-игры, получайте доступ к классическим играм и облачным сохранениям.',
                'price' => 499,
                'subscription_period' => '1_month',
                'featured' => false,
                'rating' => 4,
                'reviews_count' => 234,
            ],

            // VPN и Безопасность
            [
                'category' => 'VPN и Безопасность',
                'name' => 'NordVPN Premium',
                'description' => 'Быстрый и надежный VPN сервис',
                'long_description' => 'Защитите вашу конфиденциальность с помощью NordVPN. Высокоскоростное соединение, шифрование военного уровня и серверы в 60+ странах.',
                'price' => 1590,
                'subscription_period' => '1_month',
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 678,
            ],
            [
                'category' => 'VPN и Безопасность',
                'name' => 'ExpressVPN',
                'description' => 'Премиум VPN с быстрой скоростью',
                'long_description' => 'ExpressVPN обеспечивает максимальную безопасность и скорость. Подходит для потокового видео и загрузок файлов.',
                'price' => 1890,
                'subscription_period' => '1_month',
                'featured' => false,
                'rating' => 5,
                'reviews_count' => 543,
            ],
            [
                'category' => 'VPN и Безопасность',
                'name' => 'Proton VPN',
                'description' => 'Швейцарский VPN с отличной приватностью',
                'long_description' => 'Proton VPN - швейцарский сервис с шифрованием end-to-end и политикой нулевых логов.',
                'price' => 1390,
                'subscription_period' => '1_month',
                'featured' => false,
                'rating' => 4,
                'reviews_count' => 298,
            ],

            // SaaS сервисы
            [
                'category' => 'SaaS сервисы',
                'name' => 'Figma Professional',
                'description' => 'Профессиональный дизайн в облаке',
                'long_description' => 'Figma - это облачный инструмент дизайна для создания интерфейсов, прототипов и дизайн-системы. Работайте в команде в реальном времени.',
                'price' => 1290,
                'subscription_period' => '1_month',
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 456,
            ],
            [
                'category' => 'SaaS сервисы',
                'name' => 'Notion Personal',
                'description' => 'Организация и планирование работы',
                'long_description' => 'Notion - универсальная платформа для создания заметок, баз данных, вики и проектов.',
                'price' => 990,
                'subscription_period' => '1_month',
                'featured' => false,
                'rating' => 5,
                'reviews_count' => 678,
            ],
            [
                'category' => 'SaaS сервисы',
                'name' => 'Adobe Creative Cloud',
                'description' => 'Полный набор инструментов для творчества',
                'long_description' => 'Adobe Creative Cloud включает Photoshop, Illustrator, Premiere Pro и другие профессиональные приложения.',
                'price' => 7990,
                'subscription_period' => '1_month',
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 834,
            ],

            // Потоковые платформы
            [
                'category' => 'Потоковые платформы',
                'name' => 'Spotify Premium',
                'description' => 'Миллионы песен без рекламы',
                'long_description' => 'Spotify Premium дает вам доступ к миллионам песен, подкастов и аудиокниг. Слушайте офлайн и наслаждайтесь высоким качеством звука.',
                'price' => 1290,
                'subscription_period' => '1_month',
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 912,
            ],
            [
                'category' => 'Потоковые платформы',
                'name' => 'Netflix Premium',
                'description' => 'Неограниченный доступ к фильмам и сериалам',
                'long_description' => 'Netflix Premium позволяет смотреть в 4K на четырех устройствах одновременно.',
                'price' => 1590,
                'subscription_period' => '1_month',
                'featured' => true,
                'rating' => 5,
                'reviews_count' => 1245,
            ],
            [
                'category' => 'Потоковые платформы',
                'name' => 'YouTube Premium',
                'description' => 'YouTube без рекламы и офлайн просмотр',
                'long_description' => 'YouTube Premium - смотрите видео без рекламы, скачивайте для офлайн просмотра, используйте фоновый режим.',
                'price' => 1290,
                'subscription_period' => '1_month',
                'featured' => false,
                'rating' => 5,
                'reviews_count' => 567,
            ],

            // Облачные хранилища
            [
                'category' => 'Облачные хранилища',
                'name' => 'Google One 2TB',
                'description' => '2TB облачного хранилища от Google',
                'long_description' => 'Облачное хранилище Google One дает вам 2TB место для фотографий, документов и видео.',
                'price' => 649,
                'subscription_period' => '1_month',
                'featured' => false,
                'rating' => 4,
                'reviews_count' => 345,
            ],
            [
                'category' => 'Облачные хранилища',
                'name' => 'iCloud+ 200GB',
                'description' => 'Облачное хранилище от Apple',
                'long_description' => 'iCloud+ включает 200GB хранилища, приватные Email-адреса и защиту от слежки.',
                'price' => 699,
                'subscription_period' => '1_month',
                'featured' => false,
                'rating' => 4,
                'reviews_count' => 289,
            ],
        ];

        foreach ($products as $product) {
            $category = Category::where('name', $product['category'])->first();

            Product::create([
                'category_id' => $category->id,
                'name' => $product['name'],
                'slug' => Str::slug($product['name']),
                'description' => $product['description'],
                'long_description' => $product['long_description'],
                'price' => $product['price'],
                'subscription_period' => $product['subscription_period'],
                'stock' => 999,
                'rating' => $product['rating'],
                'reviews_count' => $product['reviews_count'],
                'featured' => $product['featured'],
            ]);
        }

        echo "✓ Товары созданы\n";
    }
}