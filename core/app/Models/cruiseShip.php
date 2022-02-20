<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cruiseShip extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'english_name',
        'cruise_line_id',
        'effective_start_date',
        'effective_end_date',
        'early_bird',
        'early_bird_before_departure_date',
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
