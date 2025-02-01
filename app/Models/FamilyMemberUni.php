<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FamilyMemberUni extends Model
{
    use HasFactory;

    protected $table = 'family_members_uni';
    
    protected $fillable = [
        'open_application_id',
        'name',
        'email',
        'phone',
        'nationality',
        'workplace',
        'position',
        'relationship',
    ];

    public function openApplication()
    {
        return $this->belongsTo(UniversityApplication::class);
    }
    
}