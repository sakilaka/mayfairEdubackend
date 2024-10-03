<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends Model
{
    use HasFactory;

    public function getImageShowAttribute(){
        return $this->image != "" ? asset('upload/continents/'. $this?->image) : asset('frontend/images/No-image.jpg');
    }
    function countries(){
        return $this->hasMany(Country::class);
    }

    function universities(){
        return $this->hasMany(University::class,'continent_id','id');
    }

    public function countrys(){
        return $this->hasMany(Country::class,"continent_id",'id');
    }
}

