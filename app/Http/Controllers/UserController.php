<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    protected $breadcrumbs;

    public function __construct(BreadcrumbsService $breadcrumbs)
    {
        $this->breadcrumbs = $breadcrumbs;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Users', route('users.index'));

        // Get the search query from the request
        $search = $request->input('search');

        $users = User::when($search, function($query, $search) {
            // Search in first name and last name combined
            return $query->where(function($query) use ($search) {
                $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"])
                      ->orWhere('first_name', 'like', "%{$search}%")
                      ->orWhere('last_name', 'like', "%{$search}%")
                      ->orWhere('email', 'like', "%{$search}%")
                      ->orWhere('company_name', 'like', "%{$search}%");
            });
        })->paginate(10); // Paginate the results

        return view('users.index', [
            'users' => $users,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Users', route('users.index'));
        $this->breadcrumbs->add('create', '#');

        $roles = Role::all();

        return view('users.create', [
            'roles' => $roles,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        DB::beginTransaction();
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'mobile_number' => $request->mobile_number,
            'professional_type' => $request->professional_type ?? null,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'country' => $request->country,
            'postcode' => $request->postcode,
        ]);

        // Assign roles to the user
        if ($request->roles) {
            // Fetch role names based on the provided IDs and assign them
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            $user->assignRole($roleNames);

            // Retrieve and sync all permissions from the selected roles to the user directly
            $permissions = Permission::whereIn('name', function ($query) use ($request, $roleNames) {
                $query->select('permissions.name')
                    ->from('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
                    ->whereIn('roles.name', $roleNames);
            })->get();

            $user->syncPermissions($permissions);
        }
        DB::commit();
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Users', route('users.index'));
        $this->breadcrumbs->add($user->name, route('users.show', $user));

        return view('users.show', [
            'user' => $user,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Users', route('users.index'));
        $this->breadcrumbs->add($user->name, route('users.edit', $user));
        $roles = Role::all();
        return view('users.edit', [
            'user' => $user,
            'roles' => $roles,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Update user info
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->mobile_number = $request->mobile_number;
        $user->address1 = $request->address1;
        $user->address2 = $request->address2;
        $user->country = $request->country;
        $user->postcode = $request->postcode;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();


        // Assign roles to the user
        if ($request->roles) {
            // Fetch role names based on the provided IDs and assign them
            $roleNames = Role::whereIn('id', $request->roles)->pluck('name')->toArray();
            $user->assignRole($roleNames);

            // Retrieve and sync all permissions from the selected roles to the user directly
            $permissions = Permission::whereIn('name', function ($query) use ($request, $roleNames) {
                $query->select('permissions.name')
                    ->from('permissions')
                    ->join('role_has_permissions', 'permissions.id', '=', 'role_has_permissions.permission_id')
                    ->join('roles', 'roles.id', '=', 'role_has_permissions.role_id')
                    ->whereIn('roles.name', $roleNames);
            })->get();

            $user->syncPermissions($permissions);
        }

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete(); // Soft delete the user
        return redirect()->route('users.index')->with('success', 'User soft-deleted successfully');
    }

    public function softDelete(User $user)
    {
        $user->delete(); // This will set the `deleted_at` timestamp for soft delete
        return redirect()->route('users.index')->with('success', 'User soft deleted successfully.');
    }

    public function hardDelete(User $user)
    {
        $user->forceDelete(); // This will permanently remove the user
        return redirect()->route('users.index')->with('success', 'User permanently deleted.');
    }


    // Restore a soft-deleted user
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore(); // Restore the user
        return redirect()->route('users.index')->with('success', 'User restored successfully');
    }

    // Permanently delete a soft-deleted user
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete(); // Permanently delete the user
        return redirect()->route('users.trashed')->with('success', 'User permanently deleted');
    }

    // Method to show edit form for user permissions
    public function editUserPermission(User $user)
    {
        $this->breadcrumbs->reset();
        $this->breadcrumbs->add('Dashboard', route('dashboard'));
        $this->breadcrumbs->add('Users', route('users.index'));
        $this->breadcrumbs->add($user->name, route('users.edit', $user));

        $permissions = Permission::all();

        return view('users.edit-permission', [
            'user' => $user,
            'permissions' => $permissions,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }

    // Method to update user permissions for a specific role
    public function updateUserPermission(Request $request, int $userId)
    {
        // Validate incoming request
        $request->validate([
            'permissions' => 'array',
            'permissions.*' => 'exists:permissions,name', // Validate by permission name
        ]);

        // Find the user
        $user = User::findOrFail($userId);

        // Get permissions by name
        $permissions = Permission::whereIn('name', $request->permissions)->pluck('name');

        // Sync permissions for the specific role
        $user->syncPermissions($permissions);

        return redirect()->route('users.edit.permission', $user->id)
            ->with('success', "Permissions for user '{$user->name}' updated successfully!");
    }
}
