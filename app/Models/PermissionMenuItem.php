<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionMenuItem extends Model
{
    use HasFactory;
    function permissions(){
        return $this->hasMany(Permission::class,'item_id','id');
    }
}
