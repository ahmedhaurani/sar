<?php

namespace App\Livewire\Admin\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class ViewRoles extends Component
{
    public $roles;
    public $roleIdToDelete = null; // Store the role ID to delete
    public function mount()
    {
        if (Gate::denies('view role')) {
            abort(403);
        }
        $this->roles = Role::all();
    }

    // public function deleteRole($roleId)
    // {
    //     if (Gate::denies('delete role')) {
    //         abort(403);
    //     }
    //     $role = Role::findOrFail($roleId);
    //     $role->delete();

    //     session()->flash('status', 'Role Deleted Successfully');
    //     $this->roles = Role::all(); // Refresh roles
    // }
    public function confirmDelete($roleId)
    {
        if (Gate::denies('delete role')) {
            abort(403);
        }
        $this->roleIdToDelete = $roleId;
        $this->dispatch('show-delete-modal'); // Trigger the modal
    }


    public function deleteConfirmed()
    {
        if (Gate::denies('delete role')) {
                    abort(403);
                }
        if ($this->roleIdToDelete) {
            $role = Role::findOrFail($this->roleIdToDelete);
            $role->delete();

            session()->flash('status', 'Role Deleted Successfully');
            $this->roleIdToDelete = null; // Reset after delete
            $this->roles = Role::all(); // Refresh roles

            $this->dispatch('closeModal'); // Close the modal
        }
    }
    public function render()
    {
        return view('livewire.admin.roles.view-roles');
    }
}
