<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cruiseLine extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'english_name', 'status'];
}
