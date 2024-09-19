<?php

namespace App\Livewire\Admin\Candidate;

use Livewire\Component;
use App\Models\Candidate;

class ViewCandidate extends Component
{
    public $candidateId;
    public $candidate;

    public function mount($candidateId)
    {
        $this->candidateId = $candidateId;
        $this->candidate = Candidate::findOrFail($candidateId);
    }

    public function render()
    {
        return view('livewire.admin.candidate.view-candidate');
    }
}
