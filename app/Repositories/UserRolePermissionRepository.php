<?php

namespace App\Repositories;

use Log;
use App\Models\User;
use App\Models\Permission;

class UserRolePermissionRepository
{
    public function getAllPermissions()
    {
        return Permission::all();
    }


    public function getUserWithRole($id)
    {
        return User::with('Role')->find($id);
    }


    public function update($id, $isChecked)
    {
        $permission = Permission::findOrFail($id);
        $permission->is_checked = $isChecked;
        $permission->save();

        return $permission;
    }



    public function destroy(array $id)
    {
        return Permission::whereIn('id', $id)->delete();
    }



}
