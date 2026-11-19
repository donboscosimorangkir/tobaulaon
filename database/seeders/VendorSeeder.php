<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    public function run(): void
    {
        Vendor::create([
            'name' => 'Toba Catering',
            'contact_person' => 'Bu Ratna',
            'phone' => '081234567891',
            'service_type' => 'Katering',
            'notes' => 'Kerja sama sejak 2025, pembayaran H-3 sebelum acara.',
        ]);

        Vendor::create([
            'name' => 'Sound System Horas',
            'contact_person' => 'Pak Tigor',
            'phone' => '081234567892',
            'service_type' => 'Sound System & MC',
            'notes' => 'Termasuk 1 unit genset cadangan.',
        ]);
    }
}
