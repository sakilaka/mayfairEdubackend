<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    
    function getImageShowAttribute(){
        return $this->image == '' ? $this->no_image : asset("upload/testimonial/".$this->image);
    }
}
