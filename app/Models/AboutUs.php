<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    use HasFactory;


    protected $fillable = [
        'banner_title',
        'banner_image1',
        'banner_image2',
        'about',
        'mission',
        'vision',
    ];

}
