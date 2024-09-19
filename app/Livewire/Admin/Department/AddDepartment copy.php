<?php

namespace App\Livewire\Admin\Department;

use Livewire\Component;
use App\Models\Department;
use Illuminate\Support\Facades\Gate;
class AddDepartment extends Component
{
    public $name, $parent_id;
    public $allDepartments;

    public function mount()
    {
        if (Gate::denies('create department')) {
            abort(403);
        }
        $this->allDepartments = Department::all();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        Department::create([
            'name' => $this->name,
            'parent_id' => $this->parent_id,
        ]);

        session()->flash('success', 'Department added successfully.');

        return redirect()->route('admin.departments.view');
    }

    public function render()
    {
        return view('livewire.admin.department.add-department');
    }
}
