<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventParticipant extends Model
{
    use HasFactory;

    public function event(){
        return $this->belongsTo(Event::class,"event_id",'id');
    }

    public function eventcarts(){
        return $this->hasMany(EventCart::class,"order_id",'id');
    }

    public function student(){
        return $this->belongsTo(User::class,"user_id",'id');
    }
}
