<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    public function eventschedules(){
        return $this->hasMany(EventSchedule::class,"event_id",'id');
    }

    public function host(){
        return $this->belongsTo(User::class,"host_id",'id');
    }


    public function b_category(){
        return $this->belongsTo(Category::class,"category_id",'id');
    }

    public function courselanguages(){
        return $this->belongsTo(CourseLanguage::class,"language_id",'id');
    }
    public function order_event(){
        return $this->belongsTo(EventParticipant::class,"event_id",'id');
    }

    public function courserequisites(){
        return $this->hasMany(CourseRequisite::class,"event_id",'id');
    }

    public function courselearns(){
        return $this->hasMany(CourseLearn::class,"event_id",'id');
    }

    public function getImageShowAttribute(){
        return $this->image != "" ? asset('upload/event/'. $this?->image) : asset('frontend/images/No-image.jpg');
    }


}
