<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShipmentDocument extends Model
{
    protected $fillable = [
        'shipment_id',
        'original_name',
        'file_name',
        'file_path',
        'mime_type',
        'file_type',
        'size',
    ];

    public function shipment()
    {
        return $this->belongsTo(Shipment::class);
    }
}

