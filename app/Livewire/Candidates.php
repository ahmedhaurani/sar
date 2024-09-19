<?php

namespace App\Livewire;

use App\Models\Governorate;
use Livewire\Component;
use App\Models\Candidate;
use App\Models\Vote;
use Illuminate\Support\Facades\Session;
use Livewire\WithPagination;

class Candidates extends Component
{
    use WithPagination;

    public $governorates;
    public $search = '';
    public $selectedGovernorate = '';
    public $perPage = 10;

    public function mount()
    {
        $this->governorates = Governorate::all();
    }

    public function like($id)
    {
        $candidate = Candidate::findOrFail($id);

        if (Session::has("liked_$id") || Session::has("disliked_$id")) {
            session()->flash('message', 'You have already voted!');
            return;
        }

        $candidate->increment('likes');
        Session::put("liked_$id", true);

        session()->flash('message', 'You liked this candidate!');
        $this->resetPage();
    }

    public function dislike($id)
    {
        $candidate = Candidate::findOrFail($id);

        if (Session::has("liked_$id") || Session::has("disliked_$id")) {
            session()->flash('message', 'You have already voted!');
            return;
        }

        $candidate->increment('dislikes');
        Session::put("disliked_$id", true);

        session()->flash('message', 'You disliked this candidate!');
        $this->resetPage();
    }

    public function vote($candidateId)
    {
        $userId = auth()->id();

        $sessionId = Session::getId();

        $existingVote = Vote::where(function ($query) use ($userId, $sessionId) {
            $query->where('user_id', $userId)
                  ->orWhere('session_id', $sessionId);
        })->first();

        if ($existingVote) {
            $existingVote->update(['candidate_id' => $candidateId]);
            session()->flash('message', "تم التصويت ");
        } else {
            Vote::create([
                'candidate_id' => $candidateId,
                'user_id' => $userId,
                'session_id' => $sessionId
            ]);
            session()->flash('message', "تم التصويت ");
        }

        $this->resetPage();
    }
    public function isFilterActive()
    {
        return !empty($this->search) || !empty($this->selectedGovernorate);
    }

    public function filterCandidates()
    {
        return Candidate::with('governorate')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedGovernorate, function ($query) {
                $query->where('governorate_id', $this->selectedGovernorate);
            })
            ->paginate($this->perPage);
    }

    public function render()
    {
        return view('livewire.candidates', [
            'candidates' => $this->filterCandidates(),
            'governorates' => $this->governorates,
        ]);
    }
}
