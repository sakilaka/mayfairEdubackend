<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstructorPageContent extends Model
{
    use HasFactory;

    public function getContentimageShowAttribute(){
        return $this->contentimage != "" ? asset('upload/instructor/contentimage/'. $this?->contentimage) : asset('frontend/images/No-image.jpg');
    }

}
