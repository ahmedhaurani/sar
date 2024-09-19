<?php

namespace App\Livewire\Admin\Candidate;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Candidate;
use App\Models\Governorate;
use Illuminate\Support\Str;

class AddCandidate extends Component
{
    use WithFileUploads;

    public $name;
    public $photo;
    public $cv;
    public $slug;
    public $governorate_id; // Add this line
    public $is_active = true; // Add this line for active status

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'slug' => 'string|max:255|unique:governorates,slug,',
            'photo' => 'nullable|image|max:1024', // Photo validation
            'cv' => 'required|string',
            'governorate_id' => 'required|exists:governorates,id', // Validation for governorate_id
        ]);

        // Save the photo
        $photoPath = $this->photo ? $this->photo->store('candidates', 'public') : null;

        Candidate::create([
            'name' => $this->name,
            'slug' => $this->slug ? Str::slug($this->slug) : Str::slug($this->name),
            'photo' => $photoPath,
            'cv' => $this->cv,
            'governorate_id' => $this->governorate_id, // Add this line
            'active' => $this->is_active, // Add this line
        ]);

        session()->flash('message', 'Candidate added successfully.');
        return redirect()->route('admin.candidates.index');

    }

    public function render()
    {
        $governorates = Governorate::all(); // Get all governorates for the dropdown

        return view('livewire.admin.candidate.add-candidate', [
            'governorates' => $governorates,
        ]);
    }
}
