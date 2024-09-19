<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Gate;

class ManageRolePermissions extends Component
{
    public $roleId;
    public $selectedPermissions = [];
    public $permissions;

    public function mount($roleId)
    {
        if (Gate::denies('view role')) {
            abort(403);
        }

        $this->roleId = $roleId;
        $this->permissions = Permission::all();
        $this->loadPermissions();
    }

    public function loadPermissions()
    {

        $role = Role::findOrFail($this->roleId);
        $this->selectedPermissions = $role->permissions->pluck('id')->toArray();
    }

    public function save()
    {
        if (Gate::denies('update role')) {
            abort(403);
        }
        $role = Role::findOrFail($this->roleId);

        // Validate selected permissions
        $validPermissions = Permission::pluck('id')->toArray();
        $this->selectedPermissions = array_intersect($this->selectedPermissions, $validPermissions);

        // Sync permissions
        $role->syncPermissions($this->selectedPermissions);

        session()->flash('status', 'Permissions updated successfully');
    }

    public function addPermission($permissionId)
    {
        if (Gate::denies('update role')) {
            abort(403);
        }
        $role = Role::findOrFail($this->roleId);

        // Check if the permission exists
        $permission = Permission::find($permissionId);
        if (!$permission) {
            session()->flash('error', 'Permission not found.');
            return;
        }

        // Add permission to the role
        $role->givePermissionTo($permission);

        // Reload permissions after addition
        $this->loadPermissions();

        session()->flash('status', 'Permission added successfully.');
    }

    public function removePermission($permissionId)
    {
        if (Gate::denies('update role')) {
            abort(403);
        }
        $role = Role::findOrFail($this->roleId);

        // Check if the permission exists
        $permission = Permission::find($permissionId);
        if (!$permission) {
            session()->flash('error', 'Permission not found.');
            return;
        }

        // Remove permission from the role
        $role->revokePermissionTo($permission);

        // Reload permissions after removal
        $this->loadPermissions();

        session()->flash('status', 'Permission removed successfully.');
    }

    public function render()
    {
        return view('livewire.admin.roles.manage-role-permissions', [
            'role' => Role::findOrFail($this->roleId),
            'permissions' => $this->permissions,
        ]);
    }
}
