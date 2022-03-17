<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotelRateTableRoomType extends Model
{
    use HasFactory;
    protected $fillable=['user_id','hotel_rate_table_id','hotel_room_type_id'];
}
