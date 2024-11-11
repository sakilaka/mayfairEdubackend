<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbookVideoContent extends Model
{
    use HasFactory;

    function getVideoFileShowAttribute(){
        return $this->video_file == '' ? $this->no_image : asset("upload/ebook/video/".$this->video_file);
    }
}
