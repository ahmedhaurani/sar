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
        // Retrieve all departments and format them hierarchically
        $this->allDepartments = $this->getFormattedDepartments();
    }

    public function store()
    {
        if (Gate::denies('create department')) {
            abort(403);
        }
        $this->validate([
            'name' => 'required',
        ]);

        Department::create([
            'name' => $this->name,
            'parent_id' => $this->parent_id ?: null, // Set parent_id to null if it's empty
        ]);

        session()->flash('success', 'Department added successfully.');

        return redirect()->route('admin.departments.view');
    }

    public function render()
    {
        return view('livewire.admin.department.add-department', [
            'departments' => $this->allDepartments,
        ]);
    }

    // Method to format departments hierarchically
    private function getFormattedDepartments()
    {
        $departments = Department::with('children')->whereNull('parent_id')->get();

        return $departments->map(function ($department) {
            return $this->formatDepartmentOptions($department);
        });
    }

    // Recursive function to format departments
    private function formatDepartmentOptions($department, $prefix = '')
    {
        $formatted = [
            'id' => $department->id,
            'name' => $prefix . $department->name,
        ];

        foreach ($department->children as $child) {
            $formatted['children'][] = $this->formatDepartmentOptions($child, $prefix . '>> ');
        }

        return $formatted;
    }
}
