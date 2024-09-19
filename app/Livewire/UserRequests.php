<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Request as UserRequest;
use Illuminate\Support\Facades\Auth;

class UserRequests extends Component
{
    public $requests;
    public $selectedRequest;
    public $attachments = [];

    public function mount()
    {
        $userId = Auth::id();
        $this->requests = UserRequest::where('user_id', $userId)
            ->with('department')
            ->get();
    }

    public function viewRequest($requestId)
    {
        $this->resetModalData();

        // Load the request data and attachments
        $this->selectedRequest = UserRequest::findOrFail($requestId);
        $this->attachments = json_decode($this->selectedRequest->attachments, true) ?? [];

        // Show modal
        $this->dispatch('show-modal');
    }

    public function closeViewModal()
    {
        // Reset the modal data
        $this->resetModalData();

        // Hide the modal
        $this->dispatch('close-modal');
    }

    protected function resetModalData()
    {
        $this->selectedRequest = null;
        $this->attachments = [];
    }

    public function render()
    {
        return view('livewire.user-requests');
    }
}
