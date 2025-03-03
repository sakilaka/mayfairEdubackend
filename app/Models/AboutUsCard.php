<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUsCard extends Model
{
    use HasFactory;
    protected $fillable = [
        'card_title',
        'card_image',
        'card_des',
    ];

}
