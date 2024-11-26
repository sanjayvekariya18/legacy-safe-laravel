<?php

namespace App\Livewire;

use Livewire\Component;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends Component
{
    public $role;
    public $permissions;

    public $selectedPermissions = [];

    public function mount($role)
    {
        $this->role = $role;
        $this->permissions = ModelsPermission::all();
        $this->selectedPermissions = $this->role->permissions->pluck('id')->toarray();
    }

    public function updatePermissions()
    {
        // Sync the permissions for the role
        $this->role->permissions()->sync($this->selectedPermissions);
    }
    public function render()
    {
        return view('livewire.permission');
    }
}
