<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function lesson()
    {
        return $this->hasMany(Lesson::class);
    }
    public function test()
    {
        return $this->hasMany(Test::class);
    }
    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
