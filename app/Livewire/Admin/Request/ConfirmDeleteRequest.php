<?php

namespace App\Livewire\Admin\Request;

use Livewire\Component;
use App\Models\Request as RequestModel;
use Illuminate\Support\Facades\Gate;

class ConfirmDeleteRequest extends Component
{
    public $requestId;

    public function mount($requestId)
    {
        $this->requestId = $requestId;

        if (Gate::denies('delete requests')) {
            abort(403);
        }
    }

    public function deleteRequest()
    {
        $request = RequestModel::findOrFail($this->requestId);
        $request->delete();

        session()->flash('status', 'Request deleted successfully.');
        return redirect()->route('admin.requests');
    }

    public function render()
    {
        return view('livewire.admin.request.confirm-delete-request', [
            'request' => RequestModel::findOrFail($this->requestId),
        ]);
    }
}
