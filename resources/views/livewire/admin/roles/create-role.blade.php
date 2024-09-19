<div>
    <div class="container mt-5">
        <a href="{{ route('roles.index') }}" class="btn btn-primary">Back to Roles</a>
    </div>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="container mt-2">
        <div class="card">
            <div class="card-header">
                <h4>Create Role</h4>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="store">
                    <div class="mb-3">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" wire:model="name" class="form-control" placeholder="Enter role name">
                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Create Role</button>
                </form>
            </div>
        </div>
    </div>
</div>
