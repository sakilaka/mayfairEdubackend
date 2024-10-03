<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'email_verified_at',
        'mobile',
        'google_id',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getImageShowAttribute(){
        return $this->image != "" ? asset("upload/users/".$this->image) : asset("frontend/images/no-profile.jpg");
    }
    public function likedBlogs()
    {
        return $this->belongsToMany(Blog::class, 'likes', 'user_id', 'blog_id');
    }
    public function certificate(){
        return $this->hasMany(Certificate::class,"user_id",'id');
    }
    public function continents(){
        return $this->belongsTo(Continent::class,"continent_id",'id');
    }
    public function office(){
        return $this->belongsTo(Office::class,"branch",'id');
    }
}
