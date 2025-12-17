<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Nasi Goreng Spesial',
                'price' => 15000,
                'category' => 'Food',
                'seller_name' => 'Nisa S',
                'image' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?auto=format&fit=crop&q=80&w=800',
                'description' => 'Nasi goreng spesial dengan telur mata sapi dan kerupuk. Dibuat dengan bumbu rahasia keluarga.',
                'location' => 'Kantin Asrama Putri',
                'rating' => 4.8,
                'reviews_count' => 2,
                'created_at' => now()->subHour(),
            ],
            [
                'name' => 'Laptop HP Pavilion',
                'price' => 4500000,
                'category' => 'Secondhand Goods',
                'seller_name' => 'Rizki',
                'image' => 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?auto=format&fit=crop&q=80&w=800',
                'description' => 'Laptop HP Pavilion bekas pemakaian wajar. Spesifikasi: Core i5, RAM 8GB, SSD 256GB. Masih mulus.',
                'location' => 'Gedung TULT',
                'rating' => 4.5,
                'reviews_count' => 1,
                'created_at' => now()->subDays(3),
            ],
            [
                'name' => 'Notebook Set Premium',
                'price' => 35000,
                'category' => 'Stationery',
                'seller_name' => 'Rafi K',
                'image' => 'https://images.unsplash.com/photo-1544816155-12df9643f363?auto=format&fit=crop&q=80&w=800',
                'description' => 'Set of 3 premium quality notebooks. 100 pages each, perfect for note-taking. Includes grid, lined, and blank pages.',
                'location' => 'Telkom University Campus',
                'rating' => 4.7,
                'reviews_count' => 3,
                'created_at' => now()->subDays(2),
            ],
            [
                'name' => 'Seragam Telkom',
                'price' => 85000,
                'category' => 'Fashion',
                'seller_name' => 'Telkom Store',
                'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&q=80&w=800',
                'description' => 'Seragam kemeja Telkom University ukuran L. Bahan adem dan nyaman dipakai.',
                'location' => 'Gedung Kuliah Umum',
                'rating' => 4.9,
                'reviews_count' => 20,
                'created_at' => now()->subDays(5),
            ],
            [
                'name' => 'Web Design Service',
                'price' => 500000,
                'category' => 'Digital Services',
                'seller_name' => 'Devano',
                'image' => 'https://images.unsplash.com/photo-1547658719-da2b51169166?auto=format&fit=crop&q=80&w=800',
                'description' => 'Jasa pembuatan desain website responsif dan modern. Pengerjaan cepat dan revisi sepuasnya.',
                'location' => 'Online',
                'rating' => 5.0,
                'reviews_count' => 8,
                'created_at' => now()->subWeek(),
            ],
            [
                'name' => 'Ayam Geprek Crispy',
                'price' => 18000,
                'category' => 'Food',
                'seller_name' => 'Maya G',
                'image' => 'https://images.unsplash.com/photo-1626082927389-6cd097cdc6ec?auto=format&fit=crop&q=80&w=800',
                'description' => 'Ayam geprek crispy dengan sambal bawang pedas nampol. Sudah termasuk nasi dan es teh.',
                'location' => 'Kantin Teknik',
                'rating' => 4.6,
                'reviews_count' => 15,
                'created_at' => now()->subHours(2),
            ],
            [
                'name' => 'Headphone Sony WH-1000XM4',
                'price' => 3200000,
                'category' => 'Secondhand Goods',
                'seller_name' => 'Sarah',
                'image' => 'https://images.unsplash.com/photo-1618366712010-f4ae9c647dcb?auto=format&fit=crop&q=80&w=800',
                'description' => 'Headphone Sony WH-1000XM4 bekas. Noise cancelling mantap, baterai awet. Lengkap dengan box.',
                'location' => 'Asrama Putra',
                'rating' => 4.8,
                'reviews_count' => 10,
                'created_at' => now()->subDays(4),
            ],
            [
                'name' => 'Pulpen Pilot Set',
                'price' => 25000,
                'category' => 'Stationery',
                'seller_name' => 'ATK Campus',
                'image' => 'https://images.unsplash.com/photo-1585336261022-680e295ce3fe?auto=format&fit=crop&q=80&w=800',
                'description' => 'Set pulpen Pilot 12 warna. Tinta lancar dan nyaman digenggam.',
                'location' => 'Koperasi Mahasiswa',
                'rating' => 4.7,
                'reviews_count' => 25,
                'created_at' => now()->subDay(),
            ],
            [
                'name' => 'Calculus Textbook',
                'price' => 120000,
                'category' => 'Secondhand Goods',
                'seller_name' => 'Ahmad',
                'image' => 'https://images.unsplash.com/photo-1544947950-fa07a98d237f?auto=format&fit=crop&q=80&w=800',
                'description' => 'Buku Kalkulus edisi 9 jilid 1. Kondisi masih bagus, tidak ada coretan.',
                'location' => 'Perpustakaan',
                'rating' => 4.6,
                'reviews_count' => 7,
                'created_at' => now()->subWeek(),
            ],
        ];

        DB::table('products')->insert($products);
    }
}
