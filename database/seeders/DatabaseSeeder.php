<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(ProductSeeder::class);

        User::updateOrCreate(
            ['email' => 'admin@belia.test'],
            [
                'name' => 'Admin Belia',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@belia.test'],
            [
                'name' => 'Belia User',
                'username' => 'beliauser',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ]
        );
    }
}
