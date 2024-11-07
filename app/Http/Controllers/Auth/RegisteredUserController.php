<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Spatie\Permission\Models\Permission;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        DB::beginTransaction();
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_number' => $request->mobile_number,
            'professional_type' => $request->professional_type ?? null,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'country' => $request->country,
            'postcode' => $request->postcode,
        ]);

        // Fetch role names based on the provided IDs and assign them
        $roleNames = $request->roles;
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
        DB::commit();
        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
