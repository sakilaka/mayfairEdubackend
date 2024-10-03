<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLessonFile extends Model
{
    use HasFactory;

    public function getNameShowAttribute(){
        return $this->name != "" ? asset('upload/course/file/'. $this?->name) : "";
    }
}
