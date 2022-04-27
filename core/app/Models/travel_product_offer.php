<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class travel_product_offer extends Model
{
    use HasFactory;
    protected $fillable=['travel_product_id','offer_id'];
}
