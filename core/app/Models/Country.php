<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'english_name', 'status','area_id'];
    public function area()
    {
        return $this->hasOne(area::class,'id', 'area_id');
    }
}
