<?php

namespace App\Livewire\Admin\Request;


use Livewire\Component;
use App\Models\Request as RequestModel;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CreateRequest extends Component
{
    public $name;
    public $description;
    public $departmentId;

    public function store()
    {
        // Authorization using Gate
        if (Gate::denies('create requests')) {
            abort(403);
        }

        $this->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'departmentId' => 'required|exists:departments,id',
        ]);

        RequestModel::create([
            'name' => $this->name,
            'description' => $this->description,
            'department_id' => $this->departmentId,
            'user_id' => Auth::id(),
        ]);

        session()->flash('status', 'Request Created Successfully');
        return redirect()->route('requests.index');
    }

    public function render()
    {
        return view('livewire.admin.create-request', [
            'departments' => Department::all(),  // Assuming you allow creating requests for all departments
        ]);
    }
}
