<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    public function getImageShowAttribute(){
        return $this->image != "" ? asset('upload/countries/'. $this?->image) : asset('frontend/images/No-image.jpg');
    }

    public function continent(){
        return $this->belongsTo(Continent::class,"continent_id",'id');
    }
    function states(){
        return $this->hasMany(State::class,'country_id','id');
    }
    function university(){
        return $this->hasMany(University::class,'country_id','id');
    }

    function universities(){
        return $this->hasMany(University::class,'country_id','id');
    }

}
