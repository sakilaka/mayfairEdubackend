<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessPackages extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'text',
        'price',
        'item'
    ];

    public function options(){
        return $this->hasMany(\App\Models\PackageOption::class,'package_id','id');
    }
}
