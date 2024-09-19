<?php

namespace App\Livewire\Admin\Candidate;

use Livewire\Component;
use App\Models\Candidate;
use App\Models\Governorate;
use Livewire\WithFileUploads;

class EditCandidate extends Component
{
    use WithFileUploads;

    public $candidateId;
    public $name;
    public $photo;
    public $cv;
    public $governorate_id;
    public $is_active;

    public function mount($candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);

        $this->candidateId = $candidateId;
        $this->name = $candidate->name;
        $this->photo = $candidate->photo;
        $this->cv = $candidate->cv;
        $this->governorate_id = $candidate->governorate_id;
        $this->is_active = $candidate->active == 1 ? true : false; // Convert 0/1 to boolean
}

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'photo' => 'nullable|image|max:1024',
            'cv' => 'required|string',
            'governorate_id' => 'required|exists:governorates,id',
        ]);

        $candidate = Candidate::findOrFail($this->candidateId);

        $photoPath = $this->photo ? $this->photo->store('candidates', 'public') : $candidate->photo;

        $candidate->update([
            'name' => $this->name,
            'photo' => $photoPath,
            'cv' => $this->cv,
            'governorate_id' => $this->governorate_id,
            'active' => $this->is_active ? 1 : 0, // Convert boolean back to 0/1

        ]);

        session()->flash('message', 'Candidate updated successfully.');
    }

    public function render()
    {
        $governorates = Governorate::all();

        return view('livewire.admin.candidate.edit-candidate', [
            'governorates' => $governorates,
        ]);
    }
}
