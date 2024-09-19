<?php

namespace App\Livewire;



use Livewire\Component;
use App\Models\Request as UserRequest;
use Illuminate\Support\Facades\Auth;

class UserRequests extends Component
{
    public $requests;

    public function mount()
    {
        $userId = Auth::id(); // Get the ID of the currently logged-in user
        $this->requests = UserRequest::where('user_id', $userId)
            ->with('department') // Optionally include department data
            ->get();
    }

    public function render()
    {
        return view('livewire.user-requests');
    }
}
