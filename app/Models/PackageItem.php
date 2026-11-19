<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PackageItem extends Model
{
    protected $fillable = ['package_id', 'itemable_type', 'itemable_id', 'quantity'];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function itemable()
    {
        return $this->morphTo();
    }
}
