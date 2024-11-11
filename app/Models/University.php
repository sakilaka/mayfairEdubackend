<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    use HasFactory;

    public function getImageShowAttribute()
    {
        return $this->image != "" ? asset("upload/university/" . $this->image) : asset("frontend/images/no-profile.jpg");
    }
    public function getBannerImageShowAttribute()
    {
        return $this->banner_image != "" ? asset("upload/university/" . $this->banner_image) : asset("frontend/images/no-profile.jpg");
    }
    public function continent()
    {
        return $this->belongsTo(Continent::class, "continent_id", 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, "country_id", 'id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, "state_id", 'id');
    }
    public function city()
    {
        return $this->belongsTo(City::class, "city_id", 'id');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, "university_id", 'id');
    }
    public function degrees()
    {
        return $this->hasMany(Degree::class, "university_id", 'id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class, "university_id", 'id');
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class, "university_id", 'id');
    }
    public function universityFAQ()
    {
        return $this->hasMany(AskQuestion::class, "university_id", 'id');
    }
}
