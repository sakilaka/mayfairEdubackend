<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=
    [
        'employee_id',
        'employee_name',
        'employee_image',
        'department_id',
        'designation_id',
        'email',
        'phone_number',
        'date_of_birth',
        'gander',
        'country',
        'city',
        'post_code',
        'nid_number',
        'qualification',
        'address',
        'salary',
        'join_date',
        'shift_name',
        'password',
        'confirm_password'
    ];
    public function getEmployeeImageShowAttribute(){
        return $this->employee_image != "" ? asset('upload/Employee_Image/'. $this?->employee_image) : asset('frontend/images/No-image.jpg');
    }
    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
    public function designation()
    {
        return $this->belongsTo(Designation::class, 'designation_id', 'id');
    }
    public function shifts()
    {
        return $this->belongsTo(Hrshift::class, 'shift_name', 'id');
    }
}
