<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $guarded = [ "id", "created_at", "updated_at" ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function courier() {
        return $this->belongsTo(Courier::class);
    }
}
