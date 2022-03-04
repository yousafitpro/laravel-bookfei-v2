<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotelRoomRate extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code',
        'hotel_room_type_id',
        'tax_percentage',
        'tax_amount',
        'room_price',
        'day',
        'adult',
        'child',
        'toddler',
        'infant',
        'senior',
        'date',
        'is_disabled'
    ];
}
