<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
    public function student()
    {
        return $this->hasOne(Student::class);
    }
    public function test()
    {
        return $this->belongsTo(Test::class);
    }

}
