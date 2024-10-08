<?php

namespace App\Livewire\Admin\Request;

use Livewire\Component;
use App\Models\Request as RequestModel;
use App\Models\Department;
use Illuminate\Support\Facades\Gate;

class EditRequest extends Component
{
    public $requestId;
    public $status;
    public $note;
    public $adminReply;
    public $attachments = [];
    public $departments;
    public $departmentId;
    public $phone_number;
    public $request_title;
    public $request_description;



    public function mount($requestId)
    {
        if (Gate::denies('update requests')) {
            abort(403);
        }

        // Load the request details
        $request = RequestModel::findOrFail($requestId);
        $this->requestId = $requestId;
        $this->status = $request->status;
        $this->note = $request->note;
        $this->adminReply = $request->admin_reply;
        $this->attachments = json_decode($request->attachments, true);
        $this->departmentId = $request->department_id;
        $this->phone_number = $request->phone_number; // Set phone number
        $this->request_title = $request->request_title;
        $this->request_description = $request->request_description;

        // Load all departments
        $this->departments = Department::all();
    }

    public function updateStatus()
    {
        if (Gate::denies('update requests')) {
            abort(403);
        }

        $this->validate([
            'status' => 'required|string',
            'adminReply' => 'nullable|string',
            'departmentId' => 'required|exists:departments,id',
        ]);

        $request = RequestModel::findOrFail($this->requestId);
        $request->update([
            'status' => $this->status,
            'admin_reply' => $this->adminReply,
            'department_id' => $this->departmentId,
        ]);

        session()->flash('status', 'تم تحديث حالة الطلب بنجاح.');
        return redirect()->route('admin.requests');
    }

    public function render()
    {
        return view('livewire.admin.request.edit-request');
    }
}
