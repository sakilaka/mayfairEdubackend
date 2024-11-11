<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Library extends Model
{
    use HasFactory;
    function getImageShowAttribute(){
        return $this->image == '' ? $this->no_image : asset("upload/library/".$this->image);
    }
}
