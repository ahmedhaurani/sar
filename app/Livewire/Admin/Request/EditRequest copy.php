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

    public function mount($requestId)
    {
        if (Gate::denies('update requests')) {
            abort(403);
        }
        $this->requestId = $requestId;

        // Load request details
        $request = RequestModel::findOrFail($requestId);
        $this->status = $request->status;
        $this->note = $request->note;
    }

    public function updateStatus()
    {
        if (Gate::denies('update request')) {
            abort(403);
        }
        $this->validate([
            'status' => 'required|string',
            'note' => 'nullable|string',
        ]);

        $request = RequestModel::findOrFail($this->requestId);
        $request->update([
            'status' => $this->status,
            'note' => $this->note,
        ]);

        session()->flash('status', 'Request status updated successfully.');
        return redirect()->route('admin.requests');
    }

    public function render()
    {
        return view('livewire.admin.request.edit-request');
    }
}
