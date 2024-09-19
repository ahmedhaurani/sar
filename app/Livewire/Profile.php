<?php

namespace App\Livewire;


use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Profile extends Component
{
    public $name, $email, $phone;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
    }

    public function render()
    {
        return view('livewire.profile');
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);

        session()->flash('message', 'Profile updated successfully.');
    }
}
