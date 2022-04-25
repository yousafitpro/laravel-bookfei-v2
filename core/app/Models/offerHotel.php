<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offerHotel extends Model
{
    use HasFactory;
    protected $fillable=['hotel_id','rate_table_id','total_num_of_hotels','hotel_group','nights','is_compulsory','offer_id'];
}
