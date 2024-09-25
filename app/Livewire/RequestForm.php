<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\Request as UserRequest;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;
class RequestForm extends Component
{

    use WithFileUploads;
    public $departments = []; // Top-level departments
    public $subDepartments = []; // Sub-departments
    public $subSubDepartments = []; // Sub-sub-departments
    public $selectedParentDepartment = null;
    public $selectedSubDepartment = null;
    public $selectedSubSubDepartment = null;
    public $note;
    public $phone_number;
    public $request_title;
    public $request_description;
    public $admin_reply;
    public $status = 'pending';
    public $attachments = []; // Array for storing multiple files

    public function mount()
    {
        // Fetch all top-level departments
        $this->departments = Department::whereNull('parent_id')->get();
    }

    public function updatedSelectedParentDepartment($parentId)
    {
        $this->subDepartments = Department::where('parent_id', $parentId)->get();
        $this->selectedSubDepartment = null;
        $this->selectedSubSubDepartment = null;
        $this->subSubDepartments = [];
    }

    public function updatedSelectedSubDepartment($subDepartmentId)
    {
        $this->subSubDepartments = Department::where('parent_id', $subDepartmentId)->get();
        $this->selectedSubSubDepartment = null;
    }


    public function submitRequest()
    {
        $this->validate([
            'selectedSubSubDepartment' => 'nullable|exists:departments,id',
            'note' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'request_title' => 'nullable|string|max:255',
            'request_description' => 'nullable|string',
            'note' => 'nullable|string',
            'attachments.*' => 'nullable|file|max:2048',  // 2MB file limit for each file

        ]);

        $uploadedFiles = [];
        if ($this->attachments) {
            foreach ($this->attachments as $file) {
                $uploadedFiles[] = $file->store('attachments', 'public');
            }
        }

        UserRequest::create([
            'user_id' => Auth::id(),
            'department_id' => $this->selectedSubSubDepartment ?? $this->selectedSubDepartment ?? $this->selectedParentDepartment,
            'note' => $this->note,
            'status' => $this->status,
            'phone_number' => $this->phone_number,
            'request_title' => $this->request_title,
            'request_description' => $this->request_description,
            'attachments' => json_encode($uploadedFiles),  // Store as JSON
        ]);

        session()->flash('message', 'تم ارسال الطلب بنجاح.');
        $this->reset();
        return redirect()->route('request.success');
    }

    public function render()
    {
        return view('livewire.request-form');
    }
}
