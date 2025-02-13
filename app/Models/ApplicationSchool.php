<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationSchool extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'year_of_completion',
        'degree_name',
        'student_roll_number',
        'major_subject',
        'cgpa',
        'certificate_issue_date',
        'school_university',
        'country_of_completion',
        'institution_address',
        'institution_website',
    ];

    public function studentApplication()
    {
        return $this->belongsTo(StudentApplication::class, 'application_id');
    }
}
