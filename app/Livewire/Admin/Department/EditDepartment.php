<?php

namespace App\Livewire\Admin\Department;


use Livewire\Component;
use App\Models\Department;
use Illuminate\Support\Facades\Gate;

class EditDepartment extends Component
{
    public $name, $parent_id, $departmentId;
    public $allDepartments;

    public function mount($id)
    {
        if (Gate::denies('update department')) {
            abort(403);
        }
        $department = Department::findOrFail($id);
        $this->departmentId = $id;
        $this->name = $department->name;
        $this->parent_id = $department->parent_id;
        $this->allDepartments = Department::all();
    }

    public function update()
    {
        if (Gate::denies('update department')) {
            abort(403);
        }
        $this->validate([
            'name' => 'required',
        ]);

        $department = Department::findOrFail($this->departmentId);
        $department->update([
            'name' => $this->name,
            'parent_id' => $this->parent_id ?: null, // Set parent_id to null if it's empty
        ]);

        session()->flash('success', 'Department updated successfully.');

        return redirect()->route('admin.departments.view');
    }

    public function render()
    {
        return view('livewire.admin.department.edit-department');
    }
}
