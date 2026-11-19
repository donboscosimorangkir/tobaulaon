<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = ['name', 'description', 'price', 'unit', 'vendor_id', 'status'];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function packageItems()
    {
        return $this->morphMany(PackageItem::class, 'itemable');
    }
}
