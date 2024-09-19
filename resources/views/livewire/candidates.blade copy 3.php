<div class="container mt-4 bg-white p-4 rounded shadow-sm">
    <!-- Button to toggle filter -->
    <button id="filterToggleButton" class="btn btn-primary" type="button">
        <i class="fas fa-filter"></i> Filter
    </button>

    <button id="filterToggleButton" class="btn btn-primary" type="button">
        <i class="fas fa-filter"></i> Filter
    </button>

    <!-- Filter Section -->
    <div id="filterSection" class="filter-section mt-3">
        <div class="card card-body">
            <div class="row">
                <!-- Search by Name -->
                <div class="col-md-4 mb-3">
                    <input type="text" id="searchInput" class="form-control" placeholder="البحث بالاسم...">
                </div>

                <!-- Governorate Filter -->
                <div class="col-md-4 mb-3">
                    <select id="governorateSelect" class="form-control">
                        <option value="">كل المحافظات</option>
                        <!-- Options will be dynamically added here -->
                        @foreach ($governorates as $governorate)
                            <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Display results -->
    <div class="row mt-4" id="results">
        @foreach ($candidates as $candidate)
            <div class="col-md-4 col-lg-3 mb-4 candidate-card" data-name="{{ $candidate->name }}" data-governorate="{{ $candidate->governorate_id }}">
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
</div>


@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const filterToggleButton = document.getElementById('filterToggleButton');
        const filterSection = document.getElementById('filterSection');
        const searchInput = document.getElementById('searchInput');
        const governorateSelect = document.getElementById('governorateSelect');
        const candidateCards = document.querySelectorAll('.candidate-card');

        // Retrieve and set saved states
        const isFilterOpen = localStorage.getItem('filterState') === 'open';
        const savedSearch = localStorage.getItem('searchValue') || '';
        const savedGovernorate = localStorage.getItem('governorateValue') || '';

        if (isFilterOpen) {
            filterSection.classList.add('show');
        }

        searchInput.value = savedSearch;
        governorateSelect.value = savedGovernorate;

        // Function to filter candidates
        function filterCandidates() {
            const searchValue = searchInput.value.toLowerCase();
            const selectedGovernorate = governorateSelect.value;

            candidateCards.forEach(card => {
                const name = card.dataset.name.toLowerCase();
                const governorate = card.dataset.governorate;
                const nameMatch = name.includes(searchValue);
                const governorateMatch = !selectedGovernorate || governorate === selectedGovernorate;

                if (nameMatch && governorateMatch) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Toggle filter section
        filterToggleButton.addEventListener('click', () => {
            if (filterSection.classList.contains('show')) {
                filterSection.classList.remove('show');
                localStorage.setItem('filterState', 'closed');
            } else {
                filterSection.classList.add('show');
                localStorage.setItem('filterState', 'open');
            }
        });

        // Save search input and governorate select values
        searchInput.addEventListener('input', () => {
            localStorage.setItem('searchValue', searchInput.value);
            filterCandidates();
        });

        governorateSelect.addEventListener('change', () => {
            localStorage.setItem('governorateValue', governorateSelect.value);
            filterCandidates();
        });

        // Initialize filter on page load
        filterCandidates();
    });
    </script>

@endpush
