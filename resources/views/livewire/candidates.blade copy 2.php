<div class="container mt-4 bg-white p-4 rounded shadow-sm">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <div class="container mt-4">
        <!-- Filter Icon Button -->
        <button class="btn btn-primary" type="button" data-bs-toggle="collapse"  id="filterToggle"  data-bs-target="#filterSection" aria-expanded="false" aria-controls="filterSection">
            <i class="fas fa-filter"></i> Filter
        </button>

        <!-- Collapsible Filter Section -->
        <div class="collapse mt-3" id="filterSection">
            <div class="card card-body">
                <div class="row">
                    <!-- Search by Name -->
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-white">
                                    <i class="fas fa-search"></i> <!-- Search Icon -->
                                </span>
                            </div>
                            <input type="text" wire:model.live="search" class="form-control" placeholder="البحث بالاسم...">
                        </div>
                    </div>

                    <!-- Governorate Filter -->
                    <div class="col-md-4 mb-3">
                        <select wire:model.live="selectedGovernorate" class="form-control">
                            <option value="">كل المحافظات</option>
                            @foreach ($governorates as $governorate)
                                <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Per Page Selector -->
                    {{-- <div class="col-md-4 mb-3">
                        <select wire:model.live="perPage" class="form-control">
                            <option value="10">عرض 10</option>
                            <option value="20">عرض 20</option>
                            <option value="50">عرض 50</option>
                        </select>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">تصفية المرشحين</h5>
            <i class="fas fa-filter text-primary"></i> <!-- Icon for filter -->
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Search by Name with Icon -->
                <div class="col-md-4 mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">

                        </div>
                        <span class="input-group-text cursor-pointer" id="password2"><i class="fas fa-search"></i></span>
                        <input type="text" wire:model.live="search" class="form-control" placeholder="البحث بالاسم...">

                    </div>
                </div>

                <!-- Governorate Filter with Icon -->
                <div class="col-md-4 mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">

                            </span>
                        </div>
                        <span class="input-group-text cursor-pointer" ><i class="fas fa-map-marker-alt"></i></span>

                        <select wire:model.live="selectedGovernorate" class="form-control">
                            <option value="">كل المحافظات</option>
                            @foreach ($governorates as $governorate)
                                <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Per Page Selector (Uncomment if needed) -->
                {{-- <div class="col-md-4">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fas fa-list"></i> <!-- List icon -->
                            </span>
                        </div>
                        <select wire:model.live="perPage" class="form-control">
                            <option value="10">عرض 10</option>
                            <option value="20">عرض 20</option>
                            <option value="50">عرض 50</option>
                        </select>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>


    <div class="row">
        @foreach ($candidates as $candidate)
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card shadow-sm h-100">
                    <!-- Candidate Image -->
                    <img src="{{ asset('storage/'.$candidate->photo) }}" alt="Candidate Photo" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">

                    <!-- Card Body -->
                    <div class="card-body d-flex flex-column">
                        <!-- Candidate Name -->
                        <h5 class="card-title">{{ $candidate->name }}</h5>

                        <!-- Vote Count -->
                        <p class="text-muted mb-3">Total Votes: {{ $candidate->totalVotes }}</p>

                        <!-- Buttons (View CV, Vote) -->
                        <div class="mt-auto">
                            <!-- View CV Modal Button -->
                            <button class="btn btn-info btn-sm mb-2 w-100" data-bs-toggle="modal" data-bs-target="#cvModal{{ $candidate->id }}">
                                View CV
                            </button>

                            <!-- Vote Button -->
                            <button wire:click="vote({{ $candidate->id }})" class="btn btn-success btn-sm w-100">
                                Vote
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CV Modal -->
            <div class="modal fade" id="cvModal{{ $candidate->id }}" tabindex="-1" aria-labelledby="cvModalLabel{{ $candidate->id }}" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="cvModalLabel{{ $candidate->id }}">CV of {{ $candidate->name }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <!-- Candidate CV -->
                            <p>{!! $candidate->cv !!}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{-- {{ $candidates->links('pagination::bootstrap-4') }} --}}
    </div>
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        const filterToggle = document.getElementById('filterToggle');
        const filterSection = document.getElementById('filterSection');
        const saveFiltersButton = document.getElementById('saveFilters');

        // Check localStorage for filter state
        const filterState = localStorage.getItem('filterState');
        if (filterState === 'open') {
            new bootstrap.Collapse(filterSection, { toggle: true });
        } else {
            new bootstrap.Collapse(filterSection, { toggle: false });
        }

        // Toggle filter section and save state
        filterToggle.addEventListener('click', () => {
            const isOpen = filterSection.classList.contains('show');
            if (isOpen) {
                localStorage.setItem('filterState', 'closed');
            } else {
                localStorage.setItem('filterState', 'open');
            }
        });

        // Save filter state on button click
        saveFiltersButton.addEventListener('click', () => {
            localStorage.setItem('filterState', 'closed');
        });
    });
</script>
@endpush
