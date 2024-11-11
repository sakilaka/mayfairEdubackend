<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityTableFilter extends Model
{
    use HasFactory;

    protected $table = 'universities_table_filter';
    protected $fillable = [
        'fields',
        'filter'
    ];
}
