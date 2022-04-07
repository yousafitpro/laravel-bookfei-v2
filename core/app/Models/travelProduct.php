<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class travelProduct extends Model
{
    use HasFactory;
    protected $casts = [
        'category' => 'array',
        'destination' => 'array',
    ];
    protected $fillable=['name','code','type','destination','category','sort_type','sort_number','effective_date_start','effective_date_end'];
}
