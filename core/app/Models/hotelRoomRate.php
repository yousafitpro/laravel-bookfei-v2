<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class hotelRoomRate extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'defualt_guest',
        'max_guest',
        'max_extra_bed',
        'max_extra_no_bed',

        'adult_age_start',
        'adult_age_end',
        'is_adult',
        'child_age_start',
        'child_age_end',
        'is_child',
        'toddler_age_start',
        'toddler_age_end',
        'is_toddler',
        'infant_age_start',
        'infant_age_end',
        'is_infant',
        'senior_age_start',
        'senior_age_end',
        'is_senior',
    ];
}
