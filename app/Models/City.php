<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public function towns()
    {
        return $this->hasMany(Town::class);
    }
    public function schools()
    {
        return $this->hasMany(School::class);
    }
}
