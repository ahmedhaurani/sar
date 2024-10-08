<?php

namespace App\Livewire\Admin\Request;

use Livewire\Component;
use App\Models\Request as RequestModel;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ManageRequests extends Component
{
    public $requests;
    public $requestIdToDelete;
    public function mount()
    {
        if (Gate::denies('view requests')) {
            abort(403);
        }
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
    public function confirmDelete($requestId)
    {
        $this->requestIdToDelete = $requestId;
        // Trigger the delete modal to open
        $this->dispatch('show-delete-confirmation');
    }

    public function deleteRequest()
    {
        if (Gate::denies('delete requests')) {
            abort(403);
        }
        $request = RequestModel::findOrFail($this->requestIdToDelete);
        $request->delete();

        session()->flash('status', 'Request deleted successfully.');
        $this->loadRequests(); // Refresh requests list after deletion

        // Close the modal after deletion
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.admin.request.manage-requests', [
            'requests' => $this->requests,
        ]);
    }
}
