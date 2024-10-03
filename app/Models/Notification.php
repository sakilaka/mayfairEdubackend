<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,"user_id",'id');
    }
    
    public function partner(){
        return $this->belongsTo(User::class,"partner_id",'id');
    }

    public function cart(){
        return $this->belongsTo(Cart::class,"relation_id",'id');
    }
    public function event_cart(){
        return $this->belongsTo(EventCart::class,"relation_id",'id');
    }
    public function event(){
        return $this->belongsTo(Event::class,"event_id",'id');
    }

    public function order(){
        return $this->belongsTo(Order::class,"order_id",'id');
    }

    public function application(){
        return $this->belongsTo(StudentApplication::class,"relation_id",'id');
    }

    function getImageShowAttribute(){
        return asset("upload/notification_image/package.webp");
    }


}
