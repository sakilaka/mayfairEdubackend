<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaestroClassSetup extends Model
{
    use HasFactory;

    function getBannerImageShowAttribute(){
        return $this->banner_image == '' ? $this->no_image : asset("upload/maestor-class/".$this->banner_image);
    }
    function getBannerVideoShowAttribute(){
        return $this->banner_video == '' ? $this->no_image : asset("upload/maestor-class/".$this->banner_video);
    }
}
