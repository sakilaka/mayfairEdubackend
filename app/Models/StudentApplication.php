<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentApplication extends Model
{
    use HasFactory;

    protected $dates = ['created_at'];

    function carts()
    {
        return $this->hasMany(Cart::class, 'application_id');
    }
    function educations()
    {
        return $this->hasMany(ApplicationSchool::class, 'application_id');
    }
    function familyMembers()
    {
        return $this->hasMany(FamilyMember::class, 'student_application_id');
    }
    function work_experiences()
    {
        return $this->hasMany(ApplicationWork::class, 'application_id');
    }
    function nationality_country()
    {
        return $this->belongsTo(Country::class, 'nationality');
    }
    function documents()
    {
        return $this->hasMany(ApplicationDocument::class, 'application_id');
    }

    function student()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    function notifications()
    {
        return $this->hasMany(Notification::class, 'relation_id', 'id');
    }

    function partner($ref)
    {
        $partner = User::find($ref);
        return $partner ?: null;
    }
}
