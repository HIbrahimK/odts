<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestStudent extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function student()
    {
        return $this->hasMany(Student::class);
    }
    public function test()
    {
        return $this->hasMany(Test::class);
    }

}
