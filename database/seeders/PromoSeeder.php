<?php

namespace Database\Seeders;

use App\Models\Promo;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class PromoSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'code' => 'WELCOME10',
                'description' => 'Добро пожаловать! 10% скидка на первый заказ',
                'discount_percent' => 10,
                'discount_amount' => null,
                'max_uses' => 100,
                'current_uses' => 23,
                'expires_at' => Carbon::now()->addDays(30),
                'active' => true,
            ],
            [
                'code' => 'SUMMER20',
                'description' => 'Летняя акция - 20% скидка на все товары',
                'discount_percent' => 20,
                'discount_amount' => null,
                'max_uses' => 200,
                'current_uses' => 145,
                'expires_at' => Carbon::now()->addDays(60),
                'active' => true,
            ],
            [
                'code' => 'SAVE500',
                'description' => 'Скидка 500 рублей на покупки свыше 5000 рублей',
                'discount_percent' => null,
                'discount_amount' => 500,
                'max_uses' => 50,
                'current_uses' => 12,
                'expires_at' => Carbon::now()->addDays(15),
                'active' => true,
            ],
            [
                'code' => 'LUCKY15',
                'description' => '15% скидка для постоянных клиентов',
                'discount_percent' => 15,
                'discount_amount' => null,
                'max_uses' => 150,
                'current_uses' => 89,
                'expires_at' => Carbon::now()->addDays(45),
                'active' => true,
            ],
            [
                'code' => 'FLASH25',
                'description' => 'Флеш-распродажа - 25% скидка (ограниченное время)',
                'discount_percent' => 25,
                'discount_amount' => null,
                'max_uses' => 30,
                'current_uses' => 28,
                'expires_at' => Carbon::now()->addHours(12),
                'active' => true,
            ],
            [
                'code' => 'EXPIRED50',
                'description' => 'Истекший промокод - 50% скидка',
                'discount_percent' => 50,
                'discount_amount' => null,
                'max_uses' => 100,
                'current_uses' => 100,
                'expires_at' => Carbon::now()->subDays(1),
                'active' => false,
            ],
        ];

        foreach ($promos as $promo) {
            Promo::create($promo);
        }

        echo "✓ Промокоды созданы\n";
    }
}