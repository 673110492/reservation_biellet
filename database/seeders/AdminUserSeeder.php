<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur admin s'il n'existe pas
        $admin = User::firstOrCreate(
            ['email' => 'admin@gmail.com'], // Condition de recherche
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
            ]
        );

        // Lui attribuer le rôle admin
        $admin->assignRole('admin');
    }
}
