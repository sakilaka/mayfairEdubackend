<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'type',
        'scholarship_amount',
        'tuition_fee',
        'accommodation_fee',
        'insurance_fee',
        'stipend_monthly',
        'stipend_yearly',
        'status'
    ];
}
