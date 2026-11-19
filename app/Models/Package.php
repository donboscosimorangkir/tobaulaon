<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image', 'status'];

    public function items()
    {
        return $this->hasMany(PackageItem::class);
    }

    // Total harga satuan kalau item-nya dibeli terpisah (buat hitung "hemat Rp...")
    public function individualPriceTotal(): float
    {
        return $this->items->sum(function ($item) {
            return $item->itemable->price * $item->quantity;
        });
    }

    public function savings(): float
    {
        return max(0, $this->individualPriceTotal() - $this->price);
    }
}
