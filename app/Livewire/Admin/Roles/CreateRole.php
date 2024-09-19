<?php

namespace App\Livewire\Admin\Roles;


use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Gate;

class CreateRole extends Component
{
    public $name;

    protected $rules = [
        'name' => 'required|string|unique:roles,name',
    ];
    public function mount()
    {
        if (Gate::denies('create role')) {
            abort(403);
        }
    }
    public function store()
    {
        if (Gate::denies('create role')) {
            abort(403);
        }
        $this->validate();

        Role::create(['name' => $this->name]);

        session()->flash('status', 'Role Created Successfully');
        return redirect()->route('roles.index');
    }

    public function render()
    {
        return view('livewire.admin.roles.create-role');
    }
}
