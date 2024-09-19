<?php

namespace App\Livewire\Admin\Candidate;

use Livewire\Component;
use App\Models\Candidate;
use App\Models\Governorate;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class EditCandidate extends Component
{
    use WithFileUploads;

    public $candidateId;
    public $name;
    public $slug;
    public $photo;
    public $cv;
    public $governorate_id;
    public $is_active;
    public $currentPhoto; // Store current photo path

    public function mount($candidateId)
    {
        $candidate = Candidate::findOrFail($candidateId);

        $this->candidateId = $candidateId;
        $this->name = $candidate->name;
        $this->slug = $candidate->slug;
        $this->photo = null; // Initialize as null for new upload
        $this->currentPhoto = $candidate->photo; // Store current photo

        $this->cv = $candidate->cv;
        $this->governorate_id = $candidate->governorate_id;
        $this->is_active = $candidate->active == 1 ? true : false; // Convert 0/1 to boolean
}

public function update()
{
    $this->validate([
        'name' => 'required|string|max:255',
        'slug' => 'string|max:255|unique:governorates,slug,',

        'photo' => 'nullable|image|max:1024',
        'cv' => 'required|string',
        'governorate_id' => 'required|exists:governorates,id',
    ]);

    // Debug the selected governorate_id

    $candidate = Candidate::findOrFail($this->candidateId);

    $photoPath = $this->photo ? $this->photo->store('candidates', 'public') : $this->currentPhoto;

    $candidate->update([
        'name' => $this->name,
        'slug' => $this->slug ? Str::slug($this->slug) : Str::slug($this->name),

        'photo' => $photoPath,
        'cv' => $this->cv,
        'governorate_id' => $this->governorate_id,
        'active' => $this->is_active ? 1 : 0,
    ]);

    if ($this->photo) {
        $this->currentPhoto = $photoPath;
    }

    session()->flash('message', 'Candidate updated successfully.');
    return redirect()->route('admin.candidates.index');

}

    public function render()
    {
        $governorates = Governorate::all();

        return view('livewire.admin.candidate.edit-candidate', [
            'governorates' => $governorates,
        ]);
    }
}
