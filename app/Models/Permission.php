<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    function menus(){
        return $this->hasMany(Permission::class,'parent_id','id');
    }
    public function menu(){
        return $this->belongsTo(PermissionMenu::class,'menu_id','id');
    }
    public function item(){
        return $this->belongsTo(PermissionMenuItem::class,'item_id','id');
    }
}
