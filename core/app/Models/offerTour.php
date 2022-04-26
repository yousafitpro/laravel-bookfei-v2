<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offerTour extends Model
{
    use HasFactory;
    protected $fillable=['offer_id','tour_id'];
}
