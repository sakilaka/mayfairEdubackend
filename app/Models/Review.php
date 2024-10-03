<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,"user_id",'id');
    }

    public function course(){
        return $this->belongsTo(Course::class,"course_id",'id');
    }
    public function ebook(){
        return $this->belongsTo(Ebook::class,"ebook_id",'id');
    }
    public function university(){
        return $this->belongsTo(University::class,"university_id",'id');
    }
}
