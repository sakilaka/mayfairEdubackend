<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UniversityApplication extends Model
{
    use HasFactory;
    protected $table = 'university_applications';

    // Define fillable attributes for mass assignment
    protected $fillable = [
        'university',
        'application_code',
        'first_name',
        'middle_name',
        'last_name',
        'chinese_name',
        'contact_id',
        'phone',
        'email',
        'dob',
        'birth_place',
        'passport_number',
        'passport_exipre_date',
        'nationality',
        'religion',
        'gender',
        'maritial_status',
        'in_chaina',
        'in_alcoholic',
        'hobby',
        'native_language',
        'english_level',
        'english_proficiency_certificate',
        'english_score',
        'certificate_issue_date',
        'chinese_level',
        'HSK_level',
        'HSK_score',
        'HSK_report_no',
        'HSKK_level',
        'HSKK_score',
        'home_country',
        'home_city',
        'home_district',
        'home_street',
        'home_zipcode',
        'home_contact_name',
        'home_contact_phone',
        'current_country',
        'current_city',
        'current_district',
        'current_street',
        'current_zipcode',
        'current_contact_name',
        'current_contact_phone',
        'father_name',
        'father_nationlity',
        'father_phone',
        'father_email',
        'father_workplace',
        'father_position',
        'father_relationship',
        'mother_name',
        'mother_nationlity',
        'mother_phone',
        'mother_email',
        'mother_workplace',
        'mother_position',
        'guarantor_inter_relation',
        'guarantor_relationship',
        'guarantor_name',
        'guarantor_address',
        'guarantor_phone',
        'guarantor_email',
        'guarantor_workplace',
        'guarantor_work_address',
        'study_fund',
        'scholarship',
        'emergency_contact_name',
        'emergency_contact_phone',
        'emergency_contact_email',
        'emergency_contact_address',
        'service_id',
        'user_id',
        'total_fee',
        'optional_fee',
        'service_charge',
        'application_fee',
        'discount_fee',
        'payment_method',
        'payment_proof',
        'status',
        'payment_status',
        'payment_status_application',
        'partner_ref_id',
        'is_applied_partner',
        'applied_by',
        'is_anonymous',
        'programs',
        'paid_amount',
        'paid_application_fees',
    ];
    
    function educations()
    {
        return $this->hasMany(UniversityEducation::class, 'application_id');
    }
    function familyMembers()
    {
        return $this->hasMany(FamilyMemberUni::class, 'open_application_id');
    }
    function work_experiences()
    {
        return $this->hasMany(UniversityWork::class, 'application_id');
    }
    function documents()
    {
        return $this->hasMany(UniversityDocument::class, 'application_id');
    }

}