<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Создаём роли
        $moderator = Role::create(['name' => 'moderator', 'display_name' => 'Модератор']);
        $reader = Role::create(['name' => 'reader', 'display_name' => 'Читатель']);

        // Создаём модератора (если не существует)
        $user = User::firstOrCreate(
            ['email' => 'moderator@example.com'],
            [
                'name' => 'Moderator',
                'password' => Hash::make('password123'),
            ]
        );
        $user->roles()->syncWithoutDetaching($moderator->id);
    }
}