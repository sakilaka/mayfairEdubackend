<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMember extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'student_application_id',
        'name',
        'email',
        'phone',
        'nationality',
        'workplace',
        'position',
        'relationship',
    ];

    public function studentApplication()
    {
        return $this->belongsTo(StudentApplication::class);
    }
}