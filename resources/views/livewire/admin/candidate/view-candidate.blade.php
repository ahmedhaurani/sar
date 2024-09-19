<div>
    <div class="card">
        <img src="{{ asset('storage/'.$candidate->photo) }}" class="card-img-top" alt="Candidate Photo">
        <div class="card-body">
            <h5 class="card-title">{{ $candidate->name }}</h5>
            <p class="card-text">{{ $candidate->cv }}</p>
            <p class="text-muted">Governorate: {{ $candidate->governorate->name }}</p>
            <p class="text-muted">Status: {{ $candidate->active ? 'Active' : 'Inactive' }}</p>
        </div>
    </div>
</div>
