<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@tmarket.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // 2. Create User 1
        $user1 = User::factory()->create([
            'name' => 'Testing User 1',
            'email' => 'testing1@tmarket.com',
            'password' => bcrypt('password123'),
        ]);

        // 3. Create 2 Products for User 1
        \App\Models\Product::create([
            'user_id' => $user1->id,
            'seller_name' => $user1->name,
            'name' => 'Gaming Laptop ROG',
            'price' => 15000000,
            'category' => 'Electronics',
            'description' => 'Laptop gaming performa tinggi, kondisi mulus 99%. Jarang dipakai.',
            'image' => 'https://images.unsplash.com/photo-1603302576837-37561b2e2302?auto=format&fit=crop&q=80&w=800',
            'location' => 'Asrama Putra',
            'rating' => 5.0,
            'reviews_count' => 1,
        ]);

        \App\Models\Product::create([
            'user_id' => $user1->id,
            'seller_name' => $user1->name,
            'name' => 'Mechanical Keyboard',
            'price' => 500000,
            'category' => 'Electronics',
            'description' => 'Keyboard mekanikal switch biru, enak buat ngetik dan gaming.',
            'image' => 'https://images.unsplash.com/photo-1595225476474-87563907a212?auto=format&fit=crop&q=80&w=800',
            'location' => 'Gedung TULT',
            'rating' => 4.5,
            'reviews_count' => 2,
        ]);

        // 4. Create User 2
        $user2 = User::factory()->create([
            'name' => 'Testing User 2',
            'email' => 'testing2@tmarket.com',
            'password' => bcrypt('password123'),
        ]);

        // 5. Create 2 Products for User 2
        \App\Models\Product::create([
            'user_id' => $user2->id,
            'seller_name' => $user2->name,
            'name' => 'Calculus Textbook',
            'price' => 150000,
            'category' => 'Books',
            'description' => 'Buku kalkulus edisi terbaru, masih bersih tanpa coretan.',
            'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=800',
            'location' => 'Perpustakaan',
            'rating' => 4.8,
            'reviews_count' => 5,
        ]);

        \App\Models\Product::create([
            'user_id' => $user2->id,
            'seller_name' => $user2->name,
            'name' => 'Scientific Calculator',
            'price' => 200000,
            'category' => 'Stationery',
            'description' => 'Kalkulator ilmiah lengkap, cocok untuk mahasiswa teknik.',
            'image' => 'https://images.unsplash.com/photo-1574607383476-f517f260d30b?auto=format&fit=crop&q=80&w=800',
            'location' => 'Gedung Kuliah Umum',
            'rating' => 4.9,
            'reviews_count' => 3,
        ]);
    }
}
