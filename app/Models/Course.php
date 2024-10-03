<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    public function getImageShowAttribute(){
        return $this->image != "" ? asset('upload/course/'. $this?->image) : asset('frontend/images/No-image.jpg');
    }

    public function courselanguages(){
        return $this->hasMany(CourseLanguage::class,"course_id",'id');
    }

    public function language(){
        return $this->belongsTo(CourseLanguage::class,"language_id",'id');
    }

    public function courserequisites(){
        return $this->hasMany(CourseRequisite::class,"course_id",'id');
    }

    public function courselessonfiles(){
        return $this->hasMany(CourseLessonFile::class,"course_id",'id');
    }

    public function courseresourcefiles(){
        return $this->hasMany(CourseResourceFile::class,"course_id",'id');
    }

    public function coursequizfiles(){
        return $this->hasMany(CourseQuizFile::class,"course_id",'id');
    }

    public function courseprojectfiles(){
        return $this->hasMany(CoursezprojectFile::class,"course_id",'id');
    }

    public function courselearns(){
        return $this->hasMany(CourseLearn::class,"course_id",'id');
    }

    public function coursecareeroutcomes(){
        return $this->hasMany(CourseCareerOutcome::class,"course_id",'id');
    }

    public function courseskills(){
        return $this->hasMany(CourseSkill::class,"course_id",'id');
    }

    public function coursecontens(){
        return $this->hasMany(CourseConten::class,"course_id",'id');
    }

    public function courselessons(){
        return $this->hasMany(CourseLesson::class,"course_id",'id');
    }

    public function semesters(){
        return $this->hasMany(Semester::class,"course_id",'id');
    }

    public function eventschedules(){
        return $this->hasMany(EventSchedule::class,"course_id",'id');
    }

    public function reviews(){
        return $this->hasMany(Review::class,"course_id",'id');
    }


    public function teacher(){
        return $this->belongsTo(User::class,"teacher_id",'id');
    }

    public function b_category(){
        return $this->belongsTo(Category::class,"category_id",'id');
    }

    public function subcategory(){
        return $this->belongsTo(Category::class,"sub_category_id",'id');
    }

    public function course_content(){
        return $this->hasMany(CourseConten::class,"course_id",'id');
    }

    // public function relatedcourses(){
    //     return $this->hasMany(RelatedCourse::class,"course_id",'id');
    // }

    public function relatedcourses(){
        return $this->hasMany(RelatedCourse::class,"relatedcourse_id",'id');
    }

    public function relcourses(){
        return $this->hasMany(RelatedCourse::class,"course_id",'id');
    }

    public function degree(){
        return $this->belongsTo(Degree::class,"degree_id",'id');
    }
    public function university(){
        return $this->belongsTo(University::class,"university_id",'id');
    }
    public function department(){
        return $this->belongsTo(Department::class,"department_id",'id');
    }
    
    public function intake(){
        return $this->belongsTo(Section::class,"section_id",'id');
    }
    
    public function scholarship(){
        return $this->belongsTo(Scholarship::class,"scholarship_id",'id');
    }
}
