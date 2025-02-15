<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    public function semesterdetailss(){
        return $this->hasMany(SemesterDetails::class,"semester_id",'id');
    }
}
