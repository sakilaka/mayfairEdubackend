<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Hrbankbranch extends Model
{
    use HasFactory;
    
    protected $fillable=['hrbank_id','branch'];
    public function bank()
    {
        return $this->belongsTo(Hrbank::class, 'hrbank_id', 'id');
    }

}