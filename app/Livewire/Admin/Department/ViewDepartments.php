<?php

namespace App\Livewire\Admin\Department;

use Livewire\Component;
use App\Models\Department;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Gate;
class ViewDepartments extends Component
{
    public $departments;
    public $name;
    public $parent_id;
    public $departmentIdBeingEdited = null;

    public function mount()
    {
        if (Gate::denies('view department')) {
            abort(403);
        }
        $this->departments = Department::with('children')->whereNull('parent_id')->get();
    }

    public function render()
    {
        return view('livewire.admin.department.view-departments');
    }

    public function edit($id)
    {
        $department = Department::find($id);
        $this->name = $department->name;
        $this->parent_id = $department->parent_id;
        $this->departmentIdBeingEdited = $department->id;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:departments,id',
        ]);

        $department = Department::find($this->departmentIdBeingEdited);
        $department->name = $this->name;
        $department->parent_id = $this->parent_id;
        $department->save();

        Session::flash('success', 'Department updated successfully.');

        $this->resetForm();
        $this->departments = Department::with('children')->whereNull('parent_id')->get();
    }

    public function delete($id)
    {
        $department = Department::find($id);
        $department->delete();

        Session::flash('success', 'Department deleted successfully.');

        $this->departments = Department::with('children')->whereNull('parent_id')->get();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->parent_id = '';
        $this->departmentIdBeingEdited = null;
    }
}
