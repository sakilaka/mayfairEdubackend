<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hrbank extends Model
{
    use HasFactory;
    
    protected $fillable=['bank_name', 'bank_type'];
    public function hrbankbranch(): HasMany
    {
        return $this->hasMany(Hrbankbranch::class);
    }
}