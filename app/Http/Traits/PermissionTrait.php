<?php
namespace App\Http\Traits;
use App\Models\RolePermission;
trait PermissionTrait {
    public function hasPermission($permission) {
        return $this->role->permissions->where('permission.route',$permission);
    }
}
