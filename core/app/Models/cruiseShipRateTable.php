<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cruiseShipRateTable extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code',
        'cruise_ship_id',
        'currency_id',
        'supplier_id',
        'hotel_id',
        'effective_start_date',
        'effective_end_date',
        'early_bird',
        'early_bird_before_departure_date',
        'bonus_night',
        'night',
        'nights',
        'min_nights',
        'max_nights',
        'x_nights',
        'y_nights',

    ];
}
