<?php

namespace App\Livewire;


use Livewire\Component;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Session;

class Candidates extends Component
{
    public $candidates;

    public function mount()
    {
        $this->candidates = Candidate::where('active', true)->get();
    }

    public function vote($candidateId)
    {
        $userId = auth()->id(); // User ID, or null if not logged in
        $sessionId = Session::getId(); // Session ID for guests

        // Check if there's an existing vote by user or session
        $existingVote = Vote::where(function ($query) use ($userId, $sessionId) {
            $query->where('user_id', $userId)
                  ->orWhere('session_id', $sessionId);
        })->first();

        if ($existingVote) {
            // Update the existing vote record with the new candidate ID
            $existingVote->update(['candidate_id' => $candidateId]);

            session()->flash('message', "Your vote has been updated to candidate #$candidateId.");
        } else {
            // Create a new vote record
            Vote::create([
                'candidate_id' => $candidateId,
                'user_id' => $userId,
                'session_id' => $sessionId
            ]);

            session()->flash('message', "Your vote has been recorded for candidate #$candidateId.");
        }

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
