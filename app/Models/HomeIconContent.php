<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeIconContent extends Model
{
    use HasFactory;
    function getIconShowAttribute(){
        return $this->icon == '' ? $this->no_image : asset("upload/home_content/".$this->icon);
    }
    function getNoImageAttribute(){
        return asset("frontend/images/No-image.jpg");
    }
}
