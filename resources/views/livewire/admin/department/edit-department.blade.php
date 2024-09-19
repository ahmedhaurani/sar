<div class="container mx-auto">
    <h2 class="text-2xl font-bold mb-4">Edit Department</h2>

    <form wire:submit.prevent="update">
        <div class="mb-4">
            <label for="name" class="block text-gray-700 font-bold mb-2">Department Name</label>
            <input type="text" wire:model="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" required>
            @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label for="parent_id" class="block text-gray-700 font-bold mb-2">Parent Department (Optional)</label>
            <select wire:model="parent_id" id="parent_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700">
                <option value="">None</option>
                @foreach ($allDepartments as $dept)
                    <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                @endforeach
            </select>
            @error('parent_id') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Update Department</button>
    </form>
</div>
