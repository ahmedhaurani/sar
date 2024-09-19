<?php

namespace App\Livewire\Admin\Roles;


use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;


class EditRole extends Component
{
    public $roleId;
    public $name;

    public function mount($roleId)
    {
        if (Gate::denies('update role')) {
            abort(403);
        }

        $this->roleId = $roleId;
        $role = Role::findOrFail($roleId);
        $this->name = $role->name; // This should correctly set the name property
    }

    public function rules()
    {
        return [
            'name' => 'required|string|unique:roles,name,' . $this->roleId,
        ];
    }

    public function update()
    {
        if (Gate::denies('update role')) {
            abort(403);
        }
        $this->validate();

        $role = Role::findOrFail($this->roleId);
        $role->update(['name' => $this->name]);

        session()->flash('status', 'Role Updated Successfully');
        return redirect()->route('roles.index');
    }
    public function render()
    {
        return view('livewire.admin.roles.edit-role');
    }
}
