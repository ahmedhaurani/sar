<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Request as RequestModel;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class ManageRequests extends Component
{
    public $requests;

    public function mount()
    {
        $this->loadRequests();
    }

    public function loadRequests()
    {
        // Get the user's assigned departments
        $userDepartments = Auth::user()->departments;

        // Collect all department IDs, including sub-departments
        $departmentIds = [];
        foreach ($userDepartments as $department) {
            // Add direct department ID
            $departmentIds[] = $department->id;

            // Add IDs of all sub-departments
            $departmentIds = array_merge($departmentIds, $this->getAllDescendantIds($department->id));
        }

        // Retrieve requests for all the user's departments and sub-departments
        $this->requests = RequestModel::whereIn('department_id', array_unique($departmentIds))->get();
    }

    private function getAllDescendantIds($parentId)
    {
        $departmentIds = [];
        $departments = Department::where('parent_id', $parentId)->get();

        foreach ($departments as $department) {
            $departmentIds[] = $department->id;
            $departmentIds = array_merge($departmentIds, $this->getAllDescendantIds($department->id));
        }

        return $departmentIds;
    }

    public function render()
    {
        return view('livewire.admin.request.manage-requests', [
            'requests' => $this->requests,
        ]);
    }
}
