<div>
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="submitRequest">
        <div class="mb-3">
            <label for="department" class="form-label">Select Department</label>
            <select wire:model="selectedDepartment" class="form-control" id="department">
                <option value="">Select Department</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            @error('selectedDepartment') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label for="note" class="form-label">Note</label>
            <textarea wire:model="note" class="form-control" id="note" rows="3"></textarea>
            @error('note') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-primary">Submit Request</button>
    </form>
</div>
