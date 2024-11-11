<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSchedule extends Model
{
    use HasFactory;



    public function instrutor(){
        return $this->belongsTo(User::class,"instrutor_id",'id');
    }


}
