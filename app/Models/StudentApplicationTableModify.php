<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApplicationTableModify extends Model
{
    use HasFactory;

    protected $table = 'student_applications_table_filter';
    protected $fillable = [
        'user_id',
        'page_route',
        'fields',
        'filter'
    ];
}
