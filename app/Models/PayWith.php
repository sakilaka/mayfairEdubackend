<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayWith extends Model
{
    use HasFactory;

    function getPayImageShowAttribute(){
        return asset("upload/pay_image/".$this->pay_image);
    }
}
