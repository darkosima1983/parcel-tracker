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

    // Optional: status constants
        const STATUS_IN_PROGRESS = 'in_progress';
        const STATUS_UNASSIGNED  = 'unassigned';
        const STATUS_COMPLETED   = 'completed';
        const STATUS_PROBLEM     = 'problem';

        public static function getStatuses(): array
        {
            return [
                self::STATUS_IN_PROGRESS,
                self::STATUS_UNASSIGNED,
                self::STATUS_COMPLETED,
                self::STATUS_PROBLEM,
            ];
        }

}
