<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    use HasFactory;
    protected $fillable=['level','name','school_id'];
    public function student()
    {
        return $this->hasOne(Student::class);
    }
}
