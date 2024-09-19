<?php

namespace App\Livewire\Admin\Candidate;

use Livewire\Component;
use Livewire\WithPagination; // Import the pagination trait
use App\Models\Candidate;
use App\Models\Governorate;

class ViewAllCandidates extends Component
{
    use WithPagination; // Use the pagination trait

    public $governorates;
    public $search = '';
    public $selectedGovernorate = '';
    public $perPage = 10; // Default to 10 items per page
    public function mount()
    {
        // Fetch all governorates for the filter dropdown
        $this->governorates = Governorate::all(); // Ensure this is not returning null
    }

    public function updated($property)
    {
        // Reset pagination when search or filter is updated
        $this->resetPage();
    }

    public function filterCandidates()
    {
        // Filter and paginate candidates by search term and selected governorate
        return Candidate::with('governorate')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->when($this->selectedGovernorate, function ($query) {
                $query->where('governorate_id', $this->selectedGovernorate);
            })
            ->paginate($this->perPage); // Paginate with the per-page value
    }

    public function render()
    {
        return view('livewire.admin.candidate.view-all-candidates', [
            'candidates' => $this->filterCandidates(),
            'governorates' => Governorate::all(),
        ]);
    }
}
