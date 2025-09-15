<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Jalankan seeder untuk user admin.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@mail.com'], 
            [
                'name' => 'Admin',
                'password' => Hash::make('adminhotel'),
                'role' => 'admin',
            ]
        );
    }
}
