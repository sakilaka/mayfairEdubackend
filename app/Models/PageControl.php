<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageControl extends Model
{
    use HasFactory;
    protected $table = 'page_controls';
    protected $fillable = [
        'page',
        'url',
        'slug'
    ];
}
