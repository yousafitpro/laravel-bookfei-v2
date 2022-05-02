<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    use HasFactory;
    protected $casts = [
        'tag' => 'array',
    ];
    protected $fillable=['name','code','type','tag','sort_number',
        'effective_date_start','effective_date_end',
        'departure_date_start','departure_date_end',
        'booking_date_start','booking_date_end',
        'min_guest','max_guest','markup_type',
        'markup_percentage','markup_amount',
        'effective_date_start','effective_date_end',
        'agent_commission','status',
        'commission_percentage','commission_amount'
    ];
}
