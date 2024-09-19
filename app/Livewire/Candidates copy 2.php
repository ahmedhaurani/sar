<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Candidate;
use Illuminate\Support\Facades\Session;

class Candidates extends Component
{
    public $candidates;

    public function mount()
    {
        $this->candidates = Candidate::where('active', true)->get();
    }

    public function vote($newCandidateId)
    {
        $userId = auth()->id(); // Assuming the user is authenticated

        // Check if the user has already voted
        $previousVote = Session::get("voted_$userId");

        if (is_array($previousVote)) {
            $previousCandidateId = $previousVote['candidate_id'];

            if ($previousCandidateId == $newCandidateId) {
                session()->flash('message', 'You have already voted for this candidate.');
                return;
            }

            // Remove vote from the previous candidate
            $previousCandidate = Candidate::findOrFail($previousCandidateId);
            $previousCandidate->decrement('votes');
        }

        // Add vote to the new candidate
        $newCandidate = Candidate::findOrFail($newCandidateId);
        $newCandidate->increment('votes');

        // Store the new vote in the session
        Session::put("voted_$userId", ['candidate_id' => $newCandidateId]);

        session()->flash('message', "Your vote has been updated to candidate #$newCandidateId.");
        $this->updateCandidates();
    }

    public function updateCandidates()
    {
        $this->candidates = Candidate::where('active', true)->get();
    }

    public function render()
    {
        return view('livewire.candidates');
    }
}
