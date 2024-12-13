<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Notifications\NewNotification;
use Illuminate\Support\Facades\Context;
use App\Repositories\UserRolePermissionRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserPermissionController extends Controller
{
    public function __construct(private UserRolePermissionRepository $userRolePermissionRepository)
    {}

    public function edit($id)
    {
        $user = $this->userRolePermissionRepository->getUserWithRole($id);
        $permissions = $this->userRolePermissionRepository->getAllPermissions();
        return view('document.user_permissions_update', compact('user', 'permissions'));
    }


    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'addedPermissions' => 'nullable|array',
        'addedPermissions.*' => 'exists:permissions,id',
        'removedPermissions' => 'nullable|array',
        'removedPermissions.*' => 'exists:permissions,id',
    ]);

    $addedPermissions = $validated['addedPermissions'] ?? [];
    $removedPermissions = $validated['removedPermissions'] ?? [];

    $permissionUpdated = $this->userRolePermissionRepository->updatePermissions(
        $addedPermissions,
        $removedPermissions,
        $id
    );

    if ($permissionUpdated) {

        if (!empty($addedPermissions)) {
            $addedPermissionsList = implode(", ", $addedPermissions);
            $message = "Permissions added successfully: $addedPermissionsList.";
            auth()->user()->notify(new NewNotification($message));
        }

        if (!empty($removedPermissions)) {
            $removedPermissionsList = implode(", ", $removedPermissions);
            $message = "Permissions removed successfully: $removedPermissionsList.";
            auth()->user()->notify(new NewNotification($message));
        }
    } else {
        $message = 'Failed to update permissions.';
        auth()->user()->notify(new NewNotification($message));
    }

    return redirect()->route('user-manage.index')->with('status', $message);
}




    public function destroy($id)
    {
        dd($id);
        $deleted = $this->userRolePermissionRepository->destroy($id);
        if ($deleted) {

            auth()->user()->notify(new NewNotification('Permissions deleted successfully.'));
            return response()->json(['message' => 'Permissions deleted successfully.']);
        } else {
            return response()->json(['message' => 'Failed to delete permissions.'], 500);
        }
    }

    public function show()
    {

    }
}
