<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

class Shipment extends Model
{
    use HasFactory;

     protected $table = 'shipment';
    protected $fillable = [
        'title',
        'from_city',
        'from_state',
        'to_city',
        'to_state',
        'price',
        'status',
        'user_id',
        'details',
        'client_id',
    ];

    
        const STATUS_IN_PROGRESS = 'in_progress';
        const STATUS_UNASSIGNED  = 'unassigned';
        const STATUS_COMPLETED   = 'completed';
        const STATUS_PROBLEM     = 'problem';

    public function documents()
    {
        return $this->hasMany(ShipmentDocument::class);
    }

    public function scopeUnassigned($query)
    {
        return $query->where('status', self::STATUS_UNASSIGNED);
    }

}
