<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
    'code', 'customer_id', 'package_id', 'event_date', 'pickup_date',
    'return_date', 'status', 'total_price', 'estimated_price', 'notes'
];
    public function package()
{
    return $this->belongsTo(Package::class);
}

public function services()
{
    return $this->hasMany(BookingService::class);
}

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(BookingItem::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
