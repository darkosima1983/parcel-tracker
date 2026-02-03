<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Shipments extends Model
{
    use HasFactory;


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

}
