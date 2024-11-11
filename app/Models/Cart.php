<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class,"user_id",'id');
    }

    public function course(){
        return $this->belongsTo(Course::class,"course_id",'id');
    }

    public function ebook(){
        return $this->belongsTo(Ebook::class,"ebook_id",'id');
    }

    public function order(){
        return $this->belongsTo(Order::class,"order_id",'id');
    }

    public function package(){
        return $this->belongsTo(BusinessPackages::class,"package_id",'id');
    }
}
