<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tourRate extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'code',
        'tour_id',
        'tax_percentage',
        'tax_amount',
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
