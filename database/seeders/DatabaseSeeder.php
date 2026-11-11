<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin user
        User::firstOrCreate(
            ['email' => 'admin@dewasufa.com'],
            [
                'name' => 'Admin Dewasufa',
                'phone' => '+62 811-2233-4455',
                'role' => 'admin',
                'password' => Hash::make('password123'),
            ]
        );

        // Standard user
        User::firstOrCreate(
            ['email' => 'user@dewasufa.com'],
            [
                'name' => 'Wisatawan Bali',
                'phone' => '+62 812-3456-7890',
                'role' => 'user',
                'password' => Hash::make('password123'),
            ]
        );
    }
}
