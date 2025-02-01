<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityEducation extends Model
{
    use HasFactory;
    protected $table = 'university_education';
    
    protected $fillable = [
        'school',
        'major',
        'start_date',
        'end_date',
        'country',
        'gpa_type',
    ];

    public function studentApplication()
    {
        return $this->belongsTo(StudentApplication::class);
    }
}