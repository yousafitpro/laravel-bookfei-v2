<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class config extends Model
{
    use HasFactory;
    protected $fillable = ['default_markup_type','default_markup_percentage','default_markup_amount','levy'];
}
