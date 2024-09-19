<?php

namespace App\Livewire\Admin\User;


use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class UserIndex extends Component
{
    public $users;

    public function mount()
    {
        if (Gate::denies('view user')) {
            abort(403);
        }
        $this->users = User::with('roles')->get();
    }

    public function delete($id)
    {
        if (Gate::denies('delete user')) {
            abort(403);
        }
        $user = User::findOrFail($id);
        $user->delete();
        session()->flash('status', 'User deleted successfully');
        $this->mount(); // Refresh the users after deletion
    }

    public function render()
    {
        return view('livewire.admin.user.user-index');
    }
}
