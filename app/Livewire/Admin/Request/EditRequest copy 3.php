<?php

namespace App\Livewire\Admin\Request;

use Livewire\Component;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Gate;

class EditRequest extends Component
{
    public $requestId;
    public $status;
    public $note;
    public $adminReply;
    public $attachments = [];

    public function mount($requestId)
    {
        if (Gate::denies('update requests')) {
            abort(403);
        }

        // Load request details
        $request = RequestModel::findOrFail($requestId);
        $this->requestId = $requestId;
        $this->status = $request->status;
        $this->note = $request->note;
        $this->adminReply = $request->admin_reply;
        $this->attachments = json_decode($request->attachments, true);    }

    public function updateStatus()
    {
        if (Gate::denies('update requests')) {
            abort(403);
        }

        $this->validate([
            'status' => 'required|string',
            'adminReply' => 'nullable|string',
        ]);

        $request = RequestModel::findOrFail($this->requestId);
        $request->update([
            'status' => $this->status,
            'admin_reply' => $this->adminReply,
        ]);

        session()->flash('status', 'تم تحديث حالة الطلب بنجاح.');
        return redirect()->route('admin.requests');
    }

    public function render()
    {
        return view('livewire.admin.request.edit-request');
    }
}
