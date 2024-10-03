<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseLesson extends Model
{
    use HasFactory;

    public function courselessonvideos(){
        return $this->hasMany(CourseLessonVideo::class,"course_lesson_id",'id');
    }
}
