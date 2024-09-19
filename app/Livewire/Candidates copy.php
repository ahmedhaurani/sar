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
        // Fetch all active candidates
        $this->candidates = Candidate::where('active', true)->get();
    }

    // Handle like action
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

    // Handle vote action
    public function vote($id)
    {
        $candidate = Candidate::findOrFail($id);

        if (Session::has("voted_$id")) {
            session()->flash('message', 'You have already voted for this candidate!');
            return;
        }

        // Increment votes
        $candidate->increment('votes');

        // Store in session to prevent multiple votes
        Session::put("voted_$id", true);

        session()->flash('message', 'You voted for this candidate!');
        $this->updateCandidates();
    }

    // Update candidates list after a vote/like/dislike
    public function updateCandidates()
    {
        $this->candidates = Candidate::where('active', true)->get();
    }

    public function render()
    {
        return view('livewire.candidates');
    }
}
