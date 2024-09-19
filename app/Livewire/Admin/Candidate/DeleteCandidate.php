<?php

namespace App\Livewire\Admin\Candidate;

use Livewire\Component;
use App\Models\Candidate;

class DeleteCandidate extends Component
{
    public $candidateId;

    public function mount($candidateId)
    {
        $this->candidateId = $candidateId;
    }

    public function delete()
    {
        $candidate = Candidate::findOrFail($this->candidateId);
        $candidate->delete();

        session()->flash('message', 'Candidate deleted successfully.');
        return redirect()->route('admin.candidates.index'); // Redirect to the candidates list page
    }

    public function render()
    {
        return view('livewire.admin.candidate.delete-candidate');
    }
}
