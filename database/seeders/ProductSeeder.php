<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Sortali Baoa Gold',
                'category' => 'Pria',
                'description' => 'Sortali pengantin pria dengan aksen benang emas, cocok untuk upacara adat lengkap.',
                'price' => 350000,
                'status' => 'available',
            ],
            [
                'name' => 'Sortali Boru Ragi Hotang',
                'category' => 'Wanita',
                'description' => 'Sortali pengantin wanita motif ragi hotang, dipadu hiasan kepala tradisional.',
                'price' => 450000,
                'status' => 'available',
            ],
            [
                'name' => 'Paket Sortali Couple',
                'category' => 'Paket',
                'description' => 'Satu set lengkap sortali pria dan wanita, harga lebih hemat untuk sepasang pengantin.',
                'price' => 750000,
                'status' => 'available',
            ],
            [
                'name' => 'Selendang Ulos Ragidup',
                'category' => 'Aksesoris',
                'description' => 'Selendang ulos ragidup untuk pelengkap busana adat, motif klasik warisan keluarga.',
                'price' => 200000,
                'status' => 'available',
            ],
            [
                'name' => 'Bulang-Bulang Boru',
                'category' => 'Aksesoris',
                'description' => 'Penutup kepala pengantin wanita, dihiasi manik dan benang emas.',
                'price' => 250000,
                'status' => 'available',
            ],
            [
                'name' => 'Tali-Tali Baoa',
                'category' => 'Aksesoris',
                'description' => 'Ikat kepala pengantin pria, dipakai bersama sortali untuk tampilan lengkap.',
                'price' => 180000,
                'status' => 'available',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
