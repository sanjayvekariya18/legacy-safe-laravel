<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Create roles
        foreach (User::ROLES as $role) {
            Role::create(['name' => $role]);
        }

        // Create permissions
        Permission::updateOrCreate(['name' => 'manage users']);
        Permission::updateOrCreate(['name' => 'create documents']);
        Permission::updateOrCreate(['name' => 'view documents']);
        Permission::updateOrCreate(['name' => 'edit documents']);
        Permission::updateOrCreate(['name' => 'delete documents']);
        Permission::updateOrCreate(['name' => 'can message']);

        // Assign permissions to roles as necessary
        $adminRole = Role::findByName(User::ROLE_ADMIN);
        $adminRole->givePermissionTo(Permission::all()); // Admin has all permissions

        $customerRole = Role::findByName('Customer');
        $customerRole->givePermissionTo('view documents'); // Customers can view articles
        $customerRole->givePermissionTo('create documents'); // Customers can view articles
        $customerRole->givePermissionTo('edit documents'); // Customers can view articles
        $customerRole->givePermissionTo('delete documents'); // Customers can view articles
        $customerRole->givePermissionTo('can message'); // Customers can view articles

        $professionalRole = Role::findByName('Professional');
        $professionalRole->givePermissionTo(['view documents', 'edit documents', 'can message']); // Professionals can view and edit documents

        $userRole = Role::findByName('User');
        $userRole->givePermissionTo(['view documents', 'can message']); // Professionals can view and edit documents
    }
}
