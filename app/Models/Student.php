<?php

namespace App\Models;

use App\Models\Student_result;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function result()
    {
        return $this->hasMany(Student_result::class);
    }
}
