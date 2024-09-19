<div class="container mt-5">


<div class="card mt-5">
    <!-- Back Button -->

    <div class="container mt-5">
        <!-- Back Button -->
        <a href="{{ route('roles.index') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> الرجوع
        </a>
    </div>

    <!-- Status Alert -->
    @if (session('status'))
        <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="container mt-4">
        <div class="card shadow-sm">
            <!-- Card Header -->
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-edit"></i> Edit Role</h4>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <!-- Form for Editing Role -->
                <form wire:submit.prevent="update">
                    <!-- Role Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" id="name" wire:model="name" class="form-control" placeholder="Enter role name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Update Button -->
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-sync-alt"></i> تحديث
                    </button>
                </form>
            </div>
        </div>
    </div>

</div>
</div>
