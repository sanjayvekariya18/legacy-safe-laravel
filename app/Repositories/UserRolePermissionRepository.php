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


    public function updatePermissions(array $addedPermissions, array $removedPermissions, $id)
    {
        try {

            $user = User::find($id);

            if (!$user) {
                Log::warning('User ID not found: ' . $id);
                return response()->json(['message' => 'User not found.'], 404);
            }

            if (!empty($addedPermissions)) {
                $user->permissions()->attach($addedPermissions);
            }

            if (!empty($removedPermissions)) {
                $user->permissions()->detach($removedPermissions);
            }

            return response()->json(['message' => 'Permissions updated successfully.'], 200);
        } catch (\Exception $e) {
            Log::error('Error updating permissions for user ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['message' => 'Error updating permissions.'], 500);
        }
    }



    public function destroy(array $id)
    {
        return Permission::whereIn('id', $id)->delete();
    }



}
