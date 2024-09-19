<div class="container mt-4 bg-white p-4 rounded shadow-sm">
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="container mt-4">
        <!-- Toggle Filter Button -->
        <div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <div class="input-group">
                            <div class="input-group-prepend">
                            </div>
                            <span class="input-group-text cursor-pointer" id="password2">
                                <i class="fas fa-search"></i>
                            </span>
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
                </div>
            </div>
        </div>
    </div>

    <!-- Check if there are candidates -->
    @if($candidates->isEmpty())
        <div class="alert alert-warning">
            لا توجد نتائج.
        </div>
    @else
        <div class="row">
            @foreach ($candidates as $candidate)
                <div class="col-md-4 col-lg-3 mb-4">
                    <div class="card shadow-sm h-100">
                        <!-- Candidate Image -->
                        <img src="{{ asset('storage/'.$candidate->photo) }}" alt="Candidate Photo"
                             class="card-img-top img-fluid" style="height: 200px; object-fit: cover;">

                        <!-- Card Body -->
                        <div class="card-body d-flex flex-column">
                            <!-- Candidate Name -->
                            <h5 class="card-title">{{ $candidate->name }}</h5>

                            <!-- Vote Count -->
                            <p class="text-muted mb-3">مجموع الاصوات: {{ $candidate->totalVotes }}</p>

                            <!-- Buttons (View CV, Vote) -->
                            <div class="mt-auto">
                                <button class="btn btn-info btn-sm mb-2 w-100" data-bs-toggle="modal"
                                        data-bs-target="#cvModal{{ $candidate->id }}">
                                    السيرة الذاتية
                                </button>

                                <button wire:click="vote({{ $candidate->id }})" class="btn btn-success btn-sm w-100">
                                    التصويت
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- CV Modal -->
                <div class="modal fade" id="cvModal{{ $candidate->id }}" tabindex="-1"
                     aria-labelledby="cvModalLabel{{ $candidate->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="cvModalLabel{{ $candidate->id }}">السيرة الذاتية للسيد\ة {{ $candidate->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>{!! $candidate->cv !!}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
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
    @endif
</div>
