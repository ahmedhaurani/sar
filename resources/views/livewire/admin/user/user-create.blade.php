<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Create User
                <a href="{{ route('users.index') }}" class="btn btn-danger float-end">Back</a>
            </h4>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="store">

                <div class="mb-3">
                    <label for="name">Name</label>
                    <input type="text" wire:model="name" class="form-control" />
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="email">Email</label>
                    <input type="text" wire:model="email" class="form-control" />
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="password">Password</label>
                    <input type="text" wire:model="password" class="form-control" />
                    @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="roles">Roles</label>
                    <select wire:model="roles" class="form-control" multiple>
                        @foreach ($allRoles as $role)
                        <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                    @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label for="departments">Departments</label>
                    <select wire:model="departments" class="form-control" multiple>
                        @foreach ($allDepartments as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>
                    @error('departments') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
