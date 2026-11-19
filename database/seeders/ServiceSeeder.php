<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Layanan milik sendiri (TobaDecor), vendor_id kosong
        Service::create([
            'name' => 'Pemasangan Sortali',
            'description' => 'Jasa pemasangan sortali untuk pengantin pria & wanita di lokasi acara.',
            'price' => 150000,
            'unit' => 'per_acara',
            'vendor_id' => null,
            'status' => 'available',
        ]);

        Service::create([
            'name' => 'Dekorasi Pelaminan Adat',
            'description' => 'Dekorasi pelaminan bernuansa adat Batak, termasuk kain ulos dan ornamen.',
            'price' => 1500000,
            'unit' => 'per_acara',
            'vendor_id' => null,
            'status' => 'available',
        ]);

        // Layanan dari vendor mitra
        $catering = Vendor::where('name', 'Toba Catering')->first();
        Service::create([
            'name' => 'Katering Prasmanan (100 pax)',
            'description' => 'Menu prasmanan khas Batak untuk 100 orang.',
            'price' => 5000000,
            'unit' => 'per_acara',
            'vendor_id' => $catering?->id,
            'status' => 'available',
        ]);

        $sound = Vendor::where('name', 'Sound System Horas')->first();
        Service::create([
            'name' => 'Sound System & MC',
            'description' => 'Paket sound system lengkap dengan MC berpengalaman acara adat.',
            'price' => 2000000,
            'unit' => 'per_acara',
            'vendor_id' => $sound?->id,
            'status' => 'available',
        ]);
    }
}
