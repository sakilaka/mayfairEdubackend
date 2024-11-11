<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPageSetup extends Model
{
    use HasFactory;
    public function getVideoThumbnailShowAttribute(){
        return $this->video_thumbnail != "" ? asset('upload/about/'. $this?->video_thumbnail) : asset('frontend/images/No-image.jpg');
    }
    public function packagetaglines(){
        return $this->hasMany(PackageTagLine::class,"package_id",'id');
    }
}
