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


    public function like($id)
    {
        $candidate = Candidate::findOrFail($id);

        if (Session::has("liked_$id") || Session::has("disliked_$id")) {
            session()->flash('message', 'You have already voted!');
            return;
        }

        // Increment likes
        $candidate->increment('likes');

        // Store in session to prevent multiple votes
        Session::put("liked_$id", true);

        session()->flash('message', 'You liked this candidate!');
        $this->updateCandidates();
    }

    // Handle dislike action
    public function dislike($id)
    {
        $candidate = Candidate::findOrFail($id);

        if (Session::has("liked_$id") || Session::has("disliked_$id")) {
            session()->flash('message', 'You have already voted!');
            return;
        }

        // Increment dislikes
        $candidate->increment('dislikes');

        // Store in session to prevent multiple votes
        Session::put("disliked_$id", true);

        session()->flash('message', 'You disliked this candidate!');
        $this->updateCandidates();
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
