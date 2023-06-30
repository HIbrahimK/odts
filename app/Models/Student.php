<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }
    public function test()
    {
        return $this->belongsTo(Result::class);
    }
}
