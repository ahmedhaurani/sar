<div>
    <div class="container mt-5">
        <h3>Create New Request</h3>

        <form wire:submit.prevent="store">
            <div class="mb-3">
                <label for="name" class="form-label">Request Name</label>
                <input type="text" wire:model="name" class="form-control" placeholder="Enter request name">
                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea wire:model="description" class="form-control" rows="4" placeholder="Enter request description"></textarea>
                @error('description') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="departmentId" class="form-label">Department</label>
                <select wire:model="departmentId" class="form-control">
                    <option value="">Select Department</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
                @error('departmentId') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Request</button>
        </form>

        <a href="{{ route('requests.index') }}" class="btn btn-secondary mt-3">Back to Requests</a>
    </div>
</div>
