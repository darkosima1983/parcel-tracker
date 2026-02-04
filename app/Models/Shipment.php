<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
    ];

    
        const STATUS_IN_PROGRESS = 'in_progress';
        const STATUS_UNASSIGNED  = 'unassigned';
        const STATUS_COMPLETED   = 'completed';
        const STATUS_PROBLEM     = 'problem';

    

}
