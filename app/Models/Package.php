<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Package extends Model
{
    use HasFactory,Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['name','id']
            ]
        ];
    }

    public function getImageShowAttribute(){
        return $this->image != "" ? asset('upload/package/'. $this?->image) : asset('frontend/images/No-image.jpg');
    }

    public function b_category(){
        return $this->belongsTo(Category::class,"category_id",'id');
    }
    public function packagetaglines(){
        return $this->hasMany(PackageTagLine::class,"package_id",'id');
    }




    public function country(){
        return $this->belongsTo(Country::class,"country_id",'id');
    }




    public function packageitems(){
        return $this->hasMany(PackageDetails::class,"package_id",'id');
    }



}
