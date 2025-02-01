<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityWork extends Model
{
    use HasFactory;

    protected $table = 'university_works';
    
    protected $fillable = [
        'company',
        'job_title',
        'start_date',
        'end_date',
    ];

    public function studentApplication()
    {
        return $this->belongsTo(StudentApplication::class);
    }
    
}