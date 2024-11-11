<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContentSetup extends Model
{
    use HasFactory;

    function getBannerImageShowAttribute()
    {
        return $this->banner_image == '' ? $this->no_image : asset("upload/home_content/" . $this->banner_image);
    }
    function getBannerVideoShowAttribute()
    {
        return $this->banner_video == '' ? $this->no_image : asset("upload/home_content/" . $this->banner_video);
    }
    function getSubBannerImageShowAttribute()
    {
        return $this->sub_banner_image == '' ? $this->no_image : asset("upload/home_content/" . $this->sub_banner_image);
    }
    function getThumbnailImageShowAttribute()
    {
        return $this->sub_banner_thumbnail == '' ? $this->no_image : asset("upload/home_content/" . $this->sub_banner_thumbnail);
    }
    function getUniversityImageShowAttribute()
    {
        return $this->university_image == '' ? $this->no_image : asset("upload/home_content/" . $this->university_image);
    }

    function getQuestionImageShowAttribute()
    {
        return $this->question_image == '' ? $this->no_image : asset("upload/home_content/" . $this->question_image);
    }
    function getLearnImageShowAttribute()
    {
        return $this->learn_image == '' ? $this->no_image : asset("upload/home_content/" . $this->learn_image);
    }

    public function getSubBannerThumbnailShowAttribute()
    {
        return $this->sub_banner_thumbnail != "" ? asset('upload/home_content/' . $this?->sub_banner_thumbnail) : asset('frontend/images/No-image.jpg');
    }


    public function getRegisterImageShowAttribute()
    {
        return $this->register_image != "" ? asset('upload/home_content/' . $this?->register_image) : asset('frontend/images/No-image.jpg');
    }

    public function getBlogDetails($id)
    {
        return Blog::find($id);
    }
    
    public function getEventDetails($id)
    {
        return Event::find($id);
    }
    
    public function getExpoDetails($id)
    {
        return Expo::find($id);
    }
}
