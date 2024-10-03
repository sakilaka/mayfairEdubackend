<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorPageSetup extends Model
{
    use HasFactory;

    public function getimage1ShowAttribute(){
        return $this->image1 != "" ? asset('upload/instructor/'. $this?->image1) : asset('frontend/images/No-image.jpg');
    }

    public function instructorcontents(){
        return $this->hasMany(InstructorPageContent::class,"instructor_id",'id');
    }



}
