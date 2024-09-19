<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Department;
use App\Models\Request as UserRequest;
use Illuminate\Support\Facades\Auth;

class RequestForm extends Component
{
    public $departments;
    public $selectedDepartment;
    public $note;
    public $status = 'pending';

    public function mount()
    {
        // Fetch all departments for dropdown
        $this->departments = Department::all();
    }

    public function submitRequest()
    {
        $this->validate([
            'selectedDepartment' => 'required',
            'note' => 'required|string|max:255',
        ]);

        UserRequest::create([
            'user_id' => Auth::id(),
            'department_id' => $this->selectedDepartment,
            'note' => $this->note,
            'status' => $this->status,
        ]);

        session()->flash('message', 'Request submitted successfully.');
        $this->reset();
    }

    public function render()
    {
        return view('livewire.request-form');
    }
}
