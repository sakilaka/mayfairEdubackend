<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeContentLocation extends Model
{
    use HasFactory;

    public function continent(){
        return $this->belongsTo(Continent::class,"location_id",'id');
    }

    public function country(){
        return $this->belongsTo(Country::class,"location_id",'id');
    }

    public function state(){
        return $this->belongsTo(State::class,"location_id",'id');
    }

    public function city(){
        return $this->belongsTo(City::class,"location_id",'id');
    }
}
