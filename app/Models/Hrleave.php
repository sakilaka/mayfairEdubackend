<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hrleave extends Model
{
    use HasFactory;
    protected $fillable=['employee_id','leave_type','reason','status'];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}