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

        $clientRole = Role::findByName(User::ROLE_CLIENT);
        $clientRole->givePermissionTo([
            'view documents',
            'create documents',
            'edit documents',
            'delete documents',
            'can message'
        ]); // Clients can view,create,edit and delete documents

        $professionalRole = Role::findByName('Professional');
        $professionalRole->givePermissionTo([
            'view documents',
            'edit documents',
            'can message'
        ]); // Professionals can view and edit documents
    }
}
