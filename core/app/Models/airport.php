<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class airport extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'english_name', 'IATA_code', 'city_id', 'status'];
}
