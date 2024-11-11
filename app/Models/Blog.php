<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Blog extends Model
{
    use HasFactory,Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title','id']
            ]
        ];
    }

    public function b_category(){
        return $this->belongsTo(Category::class,"category_id",'id');
    }
    public function getImageShowAttribute(){
        return $this->image != "" ? asset('upload/blog/'. $this?->image) : asset('frontend/images/No-image.jpg');
    }
    public function getAuthorImageShowAttribute(){
        return $this->author_image != "" ? asset('upload/blog/'. $this?->author_image) : asset('frontend/images/No-image.jpg');
    }

    public function getVideoThumbnailShowAttribute(){
        return $this->video_thumbnail != "" ? asset('upload/blog/'. $this?->video_thumbnail) : asset('frontend/images/No-image.jpg');
    }
    public function tag()
    {
        return $this->hasMany(Tag::class, 'blog_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    public function likers()
    {
        return $this->belongsToMany(User::class, 'likes', 'blog_id', 'user_id');
    }
    public function topic(){
        return $this->belongsTo(Topic::class,"topic_id",'id');
    }


    public function likes()
    {
        return $this->hasMany(Like::class, 'blog_id', 'id');
    }
}
