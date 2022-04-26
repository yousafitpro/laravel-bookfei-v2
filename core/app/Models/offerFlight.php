<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offerFlight extends Model
{
    use HasFactory;
    protected $casts = [
        'airline' => 'array',
    ];
    protected $fillable=['offer_id','flight_route_type','arrival_airport','departure_airport','airline','class'];
}
