<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cruiseShipRoomType extends Model
{
    use HasFactory;
    protected $fillable = [
        'cruise_ship_id',
        'name',
        'status',
        'default_guest',
        'max_guest'
    ];
}
