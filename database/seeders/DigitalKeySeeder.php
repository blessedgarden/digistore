<?php

namespace Database\Seeders;

use App\Models\DigitalKey;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DigitalKeySeeder extends Seeder
{
    public function run(): void
    {
        $products = Product::all();

        foreach ($products as $product) {
            // Генерируем 50 ключей для каждого товара
            for ($i = 0; $i < 50; $i++) {
                $keyValue = strtoupper(
                    Str::random(4) . '-' .
                    Str::random(4) . '-' .
                    Str::random(4) . '-' .
                    Str::random(4)
                );

                DigitalKey::create([
                    'product_id' => $product->id,
                    'key_value' => $keyValue,
                    'status' => 'available',
                ]);
            }

            // Создаем несколько проданных ключей
            for ($i = 0; $i < rand(5, 15); $i++) {
                $keyValue = strtoupper(
                    Str::random(4) . '-' .
                    Str::random(4) . '-' .
                    Str::random(4) . '-' .
                    Str::random(4)
                );

                DigitalKey::create([
                    'product_id' => $product->id,
                    'key_value' => $keyValue,
                    'status' => 'sold',
                ]);
            }

            // Создаем несколько использованных ключей
            for ($i = 0; $i < rand(2, 8); $i++) {
                $keyValue = strtoupper(
                    Str::random(4) . '-' .
                    Str::random(4) . '-' .
                    Str::random(4) . '-' .
                    Str::random(4)
                );

                DigitalKey::create([
                    'product_id' => $product->id,
                    'key_value' => $keyValue,
                    'status' => 'used',
                    'used_at' => now()->subDays(rand(1, 30)),
                ]);
            }
        }

        echo "✓ Цифровые ключи созданы\n";
    }
}