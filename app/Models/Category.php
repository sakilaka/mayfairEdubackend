<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Category extends Model
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
    function getNoImageAttribute(){
        return asset("frontend/images/No-image.jpg");
    }
    public function getIconShowAttribute(){
        return $this->icon != "" ? asset('upload/category/'. $this?->icon) : $this->no_image;
    }
    public function getImageShowAttribute(){
        return $this->image != "" ? asset('upload/category/'. $this?->image) : $this->no_image;
    }

    public function category(){
        return $this->belongsTo(Category::class,"parent_id",'id');
    }
    public function sub_category(){
        return $this->belongsTo(Category::class,"parent_id",'id');
    }
    public function parent(){
        return $this->belongsTo(Category::class,"parent_id",'id');
    }
    public function sub(){
        return $this->hasMany(Category::class,"parent_id",'id')->orderBy('position','asc');
    }
    public function phar_sub(){
        return $this->hasMany(Category::class,"parent_id",'id')->where('type',"pharmacy");
    }
     public function sub_r(){
        return $this->sub()->with('sub_r');
    }
    // public function products(){
    //     return $this->hasMany(Product::class,"category_id",'id');
    // }
    public function packages(){
        return $this->hasMany(Package::class,"category_id",'id');
    }
    // public function sub_products(){
    //     return $this->hasMany(Product::class,"sub_category_id",'id');
    // }
    // public function child_products(){
    //     return $this->hasMany(Product::class,"child_category_id",'id');
    // }
    function phar_banners(){
        return $this->hasMany(Banner::class,"category_id",'id')->where('type','pharmacy');
    }
    function pages(){
        return $this->hasMany(Page::class,'category_id','id');
    }

    public function courses(){
        return $this->hasMany(Course::class,"category_id",'id');
    }

    // function getTypeAttribute(){
    //     if($this->type == 'home'){
    //         return 'Home';
    //     }else if($this->type == 'event'){
    //         return 'Event';
    //     }else if($this->type == 'blog'){
    //         return 'Blog';
    //     }else if($this->type == 'master_course'){
    //         return 'Master Course';
    //     }

    // }






}
