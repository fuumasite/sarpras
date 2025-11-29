<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. CREATE ADMIN (Static UUID) 
        // Ginagamit natin ang static UUID para madaling tandaan sa testing
        User::create([
            'id' => '99999999-9999-9999-9999-999999999999', 
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'), // Default password
            'role' => 'admin',
            'email_verified_at' => now(), // Auto-verified na ang Admin
        ]);

        // 2. CREATE 3 USER USERS 
        User::factory(3)->create([
            'role' => 'user',
            'password' => Hash::make('password'),
        ]);

        // 3. CREATE 5 CATEGORIES 
        $categories = [
            'Electronics',
            'Furniture',
            'Clothing',
            'Food & Beverages',
            'Office Supplies'
        ];

        foreach ($categories as $catName) {
            Category::create([
                'name' => $catName,
                'description' => 'Default description for ' . $catName
            ]);
        }
    }
}