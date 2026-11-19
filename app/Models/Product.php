<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image', 'category', 'status', 'vendor_id', 'owner_type'];

    public function bookingItems()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function vendor()
{
    return $this->belongsTo(Vendor::class);
}

public function packageItems()
{
    return $this->morphMany(PackageItem::class, 'itemable');
}

public function isAvailable($pickupDate, $returnDate)
{
    $conflict = BookingItem::where('product_id', $this->id)
        ->whereHas('booking', function ($query) use ($pickupDate, $returnDate) {
            $query->where('status', '!=', 'cancelled')
                ->where(function ($q) use ($pickupDate, $returnDate) {
                    $q->whereBetween('pickup_date', [$pickupDate, $returnDate])
                      ->orWhereBetween('return_date', [$pickupDate, $returnDate])
                      ->orWhere(function ($q2) use ($pickupDate, $returnDate) {
                          $q2->where('pickup_date', '<=', $pickupDate)
                             ->where('return_date', '>=', $returnDate);
                      });
                });
        })->exists();

    return !$conflict;
}
}
