<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpoModuleContent extends Model
{
    use HasFactory;
    
    protected $table = 'expo_module_contents';
    protected $fillable = [
        'key',
        'contents'
    ];
}
