<?php

namespace App\Livewire;

use Livewire\Component;

class Home extends Component
{
    public $message;

    // public function mount()
    // {
    //     // Initialize data or perform actions when component is mounted
    //     $this->message = 'Welcome to the Home Page!';
    // }

    public function render()
    {
        // Return the view for the Livewire component
        return view('livewire.home');
    }
}
