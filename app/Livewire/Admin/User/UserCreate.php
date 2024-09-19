<?php

namespace App\Livewire\Admin\User;


use Livewire\Component;
use App\Models\User;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Gate;

class UserCreate extends Component
{
    public $name, $email, $password, $roles = [], $departments = [];
    public $allRoles, $allDepartments;

    public function mount()
    {
        if (Gate::denies('create user')) {
            abort(403);
        }
        $this->allRoles = Role::pluck('name', 'name')->all();
        $this->allDepartments = Department::pluck('name', 'id')->all();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:20',
            'roles' => 'required',
            'departments' => 'required|array'
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $user->syncRoles($this->roles);
        $user->departments()->sync($this->departments);

        session()->flash('status', 'User created successfully');
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.admin.user.user-create');
    }
}
