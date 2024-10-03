<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ebook extends Model
{
    use HasFactory;
    public function getImageShowAttribute(){
        return $this->image != "" ? asset("upload/ebook/".$this->image) : asset("frontend/images/no-profile.jpg");
    }
    public function user(){
        return $this->belongsTo(User::class,"user_id",'id');
    }
    public function category(){
        return $this->belongsTo(Category::class,"category_id",'id');
    }
    public function sub_category(){
        return $this->belongsTo(Category::class,"sub_category_id",'id');
    }

    public function audio(){
        return $this->hasMany(EbookAudioContent::class,"ebook_id",'id');
    }
    public function video(){
        return $this->hasMany(EbookVideoContent::class,"ebook_id",'id');
    }
    public function reviews(){
        return $this->hasMany(Review::class,"ebook_id",'id');
    }
    public function relatedebooks(){
        return $this->hasMany(RelatedEbook::class,"relatedebook_id",'id');
    }


    public function ebooks(){
        return $this->hasMany(RelatedEbook::class,"ebook_id",'id');
    }

    function getContentAudioShowAttribute(){
        return $this->content_audio == '' ? $this->no_image : asset("upload/ebook/".$this->content_audio);
    }

}
