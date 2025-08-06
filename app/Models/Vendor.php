<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];

    public function materials()
    {
        return $this->hasMany(Material::class);
    }

    public function shipments()
    {
        return $this->hasMany(Shipment::class);
    }
}
