<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    public function getImageShowAttribute(){
        return $this->image != "" ? asset('upload/states/'. $this?->image) : asset('frontend/images/No-image.jpg');
    }

    public function continent(){
        return $this->belongsTo(Continent::class,"continent_id",'id');
    }

    public function country(){
        return $this->belongsTo(Country::class,"country_id",'id');
    }

    function cities(){
        return $this->hasMany(City::class,'state_id','id');
    }

    function universities(){
        return $this->hasMany(University::class,'state_id','id');
    }

}
