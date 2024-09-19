<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
class PermissionController extends Component
{
    public $permissions;
    public $permissionId;
    public $name;


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
        $this->loadPermissions();
    }

    public function edit($id)
    {
        $permission = Permission::find($id);
        $this->permissionId = $permission->id;
        $this->name = $permission->name;
    }

    public function update()
    {
        $this->validate([
            'name' => ['required', 'string', Rule::unique('permissions', 'name')->ignore($this->permissionId)],
        ]);

        $permission = Permission::find($this->permissionId);
        $permission->update(['name' => $this->name]);

        session()->flash('status', 'Permission Updated Successfully');
        $this->resetFields();
        $this->loadPermissions();
    }

    public function delete($id)
    {
        Permission::find($id)->delete();
        session()->flash('status', 'Permission Deleted Successfully');
        $this->loadPermissions();
    }

    public function resetFields()
    {
        $this->name = '';
        $this->permissionId = null;
    }

    public function render()
    {
        return view('livewire.admin.permission-controller');
    }
}
