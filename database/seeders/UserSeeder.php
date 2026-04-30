<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Администратор
        User::create([
            'name' => 'Admin',
            'email' => 'admin@digistore.ru',
            'password' => Hash::make('Admin@12345'),
            'role' => 'admin',
        ]);

        // Тестовые пользователи
        User::create([
            'name' => 'Иван Петров',
            'email' => 'ivan@example.com',
            'password' => Hash::make('User@12345'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Мария Сидорова',
            'email' => 'maria@example.com',
            'password' => Hash::make('User@12345'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Петр Федоров',
            'email' => 'petr@example.com',
            'password' => Hash::make('User@12345'),
            'role' => 'user',
        ]);

        // Создаем дополнительных пользователей
        for ($i = 1; $i <= 5; $i++) {
            User::create([
                'name' => "Пользователь $i",
                'email' => "user$i@example.com",
                'password' => Hash::make('User@12345'),
                'role' => 'user',
            ]);
        }

        echo "✓ Пользователи созданы\n";
    }
}