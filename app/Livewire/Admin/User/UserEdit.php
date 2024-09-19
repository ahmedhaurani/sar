<?php

namespace App\Livewire\Admin\User;

use Illuminate\Support\Facades\Gate;

use Livewire\Component;
use App\Models\User;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserEdit extends Component
{
    public $userId, $name, $email, $password, $roles = [], $departments = [];
    public $allRoles, $allDepartments;

    public function mount($id)
    {
        if (Gate::denies('update user')) {
            abort(403, 'You do not have permission to update this user.');
        }

        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->roles = $user->roles->pluck('name')->toArray();
        $this->departments = $user->departments->pluck('id')->toArray();

        $this->allRoles = Role::pluck('name', 'name')->all();
        $this->allDepartments = Department::pluck('name', 'id')->all();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->userId,
            'password' => 'nullable|string|min:8|max:20',
            'roles' => 'required',
            'departments' => 'required|array'
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password ? Hash::make($this->password) : $user->password,
        ]);

        $user->syncRoles($this->roles);
        $user->departments()->sync($this->departments);

        session()->flash('status', 'User updated successfully');
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.admin.user.user-edit');
    }
}
