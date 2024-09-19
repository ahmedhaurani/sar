<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <div class="row">
        @foreach ($candidates as $candidate)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset($candidate->photo) }}" alt="Candidate Photo" class="card-img-top">
                <div class="card-body">
                    <h5 class="card-title">{{ $candidate->name }}</h5>
                    <p class="card-text">{{ $candidate->cv }}</p>

                    <!-- Voting Buttons -->
                    <button wire:click="like({{ $candidate->id }})" class="btn btn-success">
                        Like ({{ $candidate->likes }})
                    </button>

                    <button wire:click="dislike({{ $candidate->id }})" class="btn btn-danger">
                        Dislike ({{ $candidate->dislikes }})
                    </button>

                    <button wire:click="vote({{ $candidate->id }})" class="btn btn-primary">
                        Vote ({{ $candidate->votes }})
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div>
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="row">
            @foreach ($candidates as $candidate)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset($candidate->photo) }}" alt="Candidate Photo" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $candidate->name }}</h5>
                            <p class="card-text">{{ $candidate->cv }}</p>

                            <!-- Display the total vote count from the votes table -->
                            <p>Total Votes: {{ $candidate->totalVotes }}</p>

                            <!-- Voting Button -->
                            <button wire:click="vote({{ $candidate->id }})" class="btn btn-primary">
                                Vote
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</div>
