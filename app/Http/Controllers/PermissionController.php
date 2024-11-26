<?php

namespace App\Http\Controllers;

use App\Services\BreadcrumbsService;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
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
        $this->breadcrumbs->add('Role & Permissions', route('permissions'));

        $roles = Role::all();
        $permissions = Permission::all();

        return view('permissions.index', [
            'roles' => $roles,
            'permissions' => $permissions,
            'breadcrumbs' => $this->breadcrumbs->get(),
        ]);
    }
}
