<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    public function getImageShowAttribute(){
        return $this->image != "" ? asset('upload/words/'. $this?->image) : asset('frontend/images/No-image.jpg');
    }

    public function continent(){
        return $this->belongsTo(Continent::class,"continent_id",'id');
    }

    public function country(){
        return $this->belongsTo(Country::class,"country_id",'id');
    }

    public function state(){
        return $this->belongsTo(State::class,"state_id",'id');
    }
    public function city(){
        return $this->belongsTo(City::class,"city_id",'id');
    }
    public function thana(){
        return $this->belongsTo(Thana::class,"thana_id",'id');
    }
    public function union(){
        return $this->belongsTo(Union::class,"union_id",'id');
    }
    public function clinics(){
        return $this->hasMany(Clinic::class,"word_id",'id');
    }

}
