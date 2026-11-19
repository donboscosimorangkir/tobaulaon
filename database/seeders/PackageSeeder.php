<?php

namespace Database\Seeders;

use App\Models\Package;
use App\Models\PackageItem;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Database\Seeder;

class PackageSeeder extends Seeder
{
    public function run(): void
    {
        $package = Package::create([
            'name' => 'Paket Adat Lengkap',
            'description' => 'Sortali couple, selendang ulos, pemasangan, dan dekorasi pelaminan dalam satu paket.',
            'price' => 2400000, // lebih murah dibanding beli satuan
            'status' => 'available',
        ]);

        $sortaliCouple = Product::where('name', 'Paket Sortali Couple')->first();
        $selendang = Product::where('name', 'Selendang Ulos Ragidup')->first();
        $pemasangan = Service::where('name', 'Pemasangan Sortali')->first();
        $dekorasi = Service::where('name', 'Dekorasi Pelaminan Adat')->first();

        if ($sortaliCouple) {
            PackageItem::create([
                'package_id' => $package->id,
                'itemable_type' => Product::class,
                'itemable_id' => $sortaliCouple->id,
                'quantity' => 1,
            ]);
        }

        if ($selendang) {
            PackageItem::create([
                'package_id' => $package->id,
                'itemable_type' => Product::class,
                'itemable_id' => $selendang->id,
                'quantity' => 1,
            ]);
        }

        if ($pemasangan) {
            PackageItem::create([
                'package_id' => $package->id,
                'itemable_type' => Service::class,
                'itemable_id' => $pemasangan->id,
                'quantity' => 1,
            ]);
        }

        if ($dekorasi) {
            PackageItem::create([
                'package_id' => $package->id,
                'itemable_type' => Service::class,
                'itemable_id' => $dekorasi->id,
                'quantity' => 1,
            ]);
        }
    }
}
