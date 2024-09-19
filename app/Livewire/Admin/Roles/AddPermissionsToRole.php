<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AddPermissionsToRole extends Component
{
    public $roleId;
    public $selectedPermissions = [];

    public function mount($roleId)
    {
        $this->roleId = $roleId;
        $this->loadPermissions();
    }

    public function loadPermissions()
    {
        $role = Role::findOrFail($this->roleId);
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
    }

    public function save()
    {
        $role = Role::findOrFail($this->roleId);
        dd($role);

        $role->syncPermissions($this->selectedPermissions);

        session()->flash('status', 'Permissions updated successfully');
        return redirect()->route('roles.index');
    }

    public function render()
    {
        return view('livewire.admin.roles.add-permissions-to-role', [
            'role' => Role::findOrFail($this->roleId),
            'permissions' => Permission::all(),
        ]);
    }
}
