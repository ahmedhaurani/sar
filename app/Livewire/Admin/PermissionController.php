<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class PermissionController extends Component
{

    public $permissions;
    public $permissionId = null;
    public $name;
    public $confirmingDelete = false;
    public $permissionToDelete = null;

    public function mount()
    {
        $this->loadPermissions();
    }

    public function loadPermissions()
    {
        $this->permissions = Permission::all();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|unique:permissions,name',
        ]);

        Permission::create(['name' => $this->name]);

        session()->flash('status', 'Permission Created Successfully');
        $this->resetFields();
        $this->dispatch('closeDeleteModal'); // Emit event to close modal
        $this->loadPermissions();
    }

    public function update()
    {
        $this->validate([
            'name' => [
                'required',
                'string',
                Rule::unique('permissions', 'name')->ignore($this->permissionId),
            ],
        ]);

        $permission = Permission::find($this->permissionId);
        $permission->update(['name' => $this->name]);

        session()->flash('status', 'Permission Updated Successfully');
        $this->resetFields();
        $this->dispatch('closeDeleteModal'); // Emit event to close modal
        $this->loadPermissions();
    }

    public function confirmDelete($id)
    {

        $this->confirmingDelete = true;
        $this->permissionToDelete = $id;
    }

    public function deleteConfirmed()
    {
        Permission::find($this->permissionToDelete)->delete();

        session()->flash('status', 'Permission Deleted Successfully');
        $this->confirmingDelete = false;
        $this->permissionToDelete = null;
      //  $this->dispatch('closeModal'); // Emit event to close modal
        $this->dispatch('closeDeleteModal'); // Emit event to close modal
        $this->loadPermissions();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->permissionId = null;
        $this->confirmingDelete = false;
        $this->permissionToDelete = null;
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        $this->permissionId = $permission->id;
        $this->name = $permission->name;
    }

    public function render()
    {
        return view('livewire.admin.permission-controller');
    }
}
