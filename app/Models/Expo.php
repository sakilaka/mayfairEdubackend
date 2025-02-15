<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expo extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_id',
        'title',
        'banner',
        'datetime',
        'place',
        'universities',
        'guests',
        'media_partner',
        'photos',
        'videos',
        'description',
        'location',
        'additional_contents',
        'testimonials',
        'delegates',
        'gallery',
        'video',
        'exhibitors',
        'join_page_contents'
    ];

    public function universities()
    {
        $universityIds = json_decode($this->universities, true) ?? [];

        if (empty($universityIds)) {
            return collect();
        }

        return University::whereIn('id', $universityIds)->get();
    }
}
