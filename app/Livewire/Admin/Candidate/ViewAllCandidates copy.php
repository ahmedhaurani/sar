<?php

namespace App\Livewire\Admin\Candidate;

use Livewire\Component;
use App\Models\Candidate;

class ViewAllCandidates extends Component
{
    public $candidates;

    public function mount()
    {
        // Fetch all candidates from the database
        $this->candidates = Candidate::with('governorate')->get();
    }

    public function render()
    {
        return view('livewire.admin.candidate.view-all-candidates', [
            'candidates' => $this->candidates,
        ]);
    }
}
