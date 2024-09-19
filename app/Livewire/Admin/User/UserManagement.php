<?php

namespace App\Livewire\Admin\User;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use App\Models\Department;

class UserManagement extends Component
{
    public $users;

    public function mount()
    {
        $this->users = User::with('roles', 'departments')->get();
    }

    public function render()
    {
        return view('livewire.admin.user.index');
    }

    public function deleteUser($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        session()->flash('status', 'User deleted successfully');
        $this->users = User::with('roles', 'departments')->get(); // Refresh user list
    }
}
