<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityDocument extends Model
{
    use HasFactory;
    protected $table = 'university_documents';
    
    protected $fillable = [
        'application_id',
        'document_name',
        'document_type',
        'document_file',
        'extensions',
    ];
    public function studentApplication()
    {
        return $this->belongsTo(StudentApplication::class);
    }
}