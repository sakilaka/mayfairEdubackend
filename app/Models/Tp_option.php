<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tp_option extends Model
{
    use HasFactory;
    protected $fillable = [
        'option_name',
        'option_value',
    ];

    function getHeaderImageShowAttribute()
    {
        return asset("upload/site_setting/" . $this->header_image);
    }
    function getFooterImageShowAttribute()
    {
        return asset("upload/site_setting/" . $this->footer_image);
    }
    function getPaymentImageShowAttribute()
    {
        return $this->payment_image != "" ? asset("upload/site_setting/" . $this->payment_image) : $this->no_image;
    }
    function getFaviconShowAttribute()
    {
        return asset("upload/site_setting/" . $this->favicon);
    }
    function getNoImageAttribute()
    {
        return asset("frontend/images/No-image.jpg");
    }
    function paywiths()
    {
        return $this->hasMany(PayWith::class, 'tp_option_id', 'id');
    }
}
