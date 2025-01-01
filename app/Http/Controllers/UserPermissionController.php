<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\NewNotification;
use App\Repositories\UserRolePermissionRepository;
use Illuminate\Http\Request;

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
        $permission = $this->userRolePermissionRepository->update($id, $request->is_checked);
        if ($permission) {
            auth()->user()->notify(new NewNotification('Permission Add SuccessFully !'));
            return redirect()->route('permissions.index')->with('success', 'Permissions Add successfully');
        }
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
