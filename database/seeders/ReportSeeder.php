<?php

namespace Database\Seeders;

use App\Models\Report;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ReportSeeder extends Seeder
{
    /**
     * Seed the reports table with sample data.
     */
    public function run(): void
    {
        // Ensure at least one category exists
        $category = Category::firstOrCreate(
            ['name' => 'General'],
            ['description' => 'General category']
        );

        // Ensure at least 3 users exist
        if (User::where('role', 'user')->count() < 3) {
            for ($i = 0; $i < 3; $i++) {
                User::factory()->create([
                    'role' => 'user',
                    'password' => Hash::make('password'),
                ]);
            }
        }

        // Ensure at least 5 products exist
        if (Product::count() < 5) {
            for ($i = 0; $i < 5; $i++) {
                Product::create([
                    'name' => 'Produk Sample ' . ($i + 1),
                    'description' => 'Deskripsi produk sample ' . ($i + 1),
                    'category_id' => $category->id,
                    'quantity' => 50,
                    'price' => 100000 + ($i * 10000),
                ]);
            }
        }

        // Get users and products
        $users = User::where('role', 'user')->get();
        $products = Product::all();

        if ($users->count() < 1 || $products->count() < 1) {
            $this->command->warn('Tidak dapat membuat laporan: users atau products masih kosong.');
            return;
        }

        // Helper function to safely get array item by index
        $safeGet = function($collection, $index) {
            return $collection->count() > $index ? $collection[$index] : $collection->first();
        };

        // Create sample reports (dynamically using available users and products)
        $reports = [
            [
                'user_id' => $safeGet($users, 0)->id,
                'product_id' => $safeGet($products, 0)->id,
                'type' => 'rusak',
                'quantity' => 2,
                'notes' => 'Produk ini mengalami kerusakan pada bagian sudut. Mohon untuk diganti atau diperbaiki.',
                'status' => 'pending',
            ],
            [
                'user_id' => $safeGet($users, 0)->id,
                'product_id' => $safeGet($products, 1)->id,
                'type' => 'peminjaman',
                'quantity' => 5,
                'notes' => 'Meminjam beberapa unit untuk acara kantor besok.',
                'status' => 'approved',
            ],
            [
                'user_id' => $safeGet($users, 1)->id,
                'product_id' => $safeGet($products, 2)->id,
                'type' => 'pengembalian',
                'quantity' => 3,
                'notes' => 'Mengembalikan produk yang dipinjam minggu lalu. Kondisi masih baik.',
                'status' => 'approved',
            ],
            [
                'user_id' => $safeGet($users, 1)->id,
                'product_id' => $safeGet($products, 0)->id,
                'type' => 'rusak',
                'quantity' => 1,
                'notes' => 'Kemasan rusak dan produk di dalamnya ada yang lecet.',
                'status' => 'rejected',
            ],
            [
                'user_id' => $safeGet($users, 0)->id,
                'product_id' => $safeGet($products, 3)->id,
                'type' => 'lainnya',
                'quantity' => 0,
                'notes' => 'Produk stok kurang. Mohon segera restok untuk memenuhi permintaan.',
                'status' => 'pending',
            ],
            [
                'user_id' => $safeGet($users, 1)->id,
                'product_id' => $safeGet($products, 4)->id,
                'type' => 'peminjaman',
                'quantity' => 10,
                'notes' => 'Pinjam untuk workshop bulan depan.',
                'status' => 'pending',
            ],
        ];

        // Insert all reports (check for existing to avoid duplicates)
        $createdCount = 0;
        foreach ($reports as $report) {
            $exists = Report::where('user_id', $report['user_id'])
                ->where('product_id', $report['product_id'])
                ->where('type', $report['type'])
                ->exists();
            
            if (!$exists) {
                Report::create($report);
                $createdCount++;
            }
        }

        $this->command->info('ReportSeeder: ' . $createdCount . ' laporan berhasil dibuat.');
    }
}
