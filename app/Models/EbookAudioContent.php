<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EbookAudioContent extends Model
{
    use HasFactory;

    function getAudioFileShowAttribute(){
        return $this->audio_file == '' ? $this->no_image : asset("upload/ebook/audio/".$this->audio_file);
    }
}
