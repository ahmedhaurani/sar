<div class="container mt-3">
    <h3>Manage Permissions for Role: {{ $role->name }}</h3>

    @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-md-4 col-lg-3 col-xl-2 mb-3">
                    <div class="form-check">
                        <input
                            type="checkbox"
                            class="form-check-input"
                            id="permission-{{ $permission->id }}"
                            value="{{ $permission->id }}"
                            wire:model="selectedPermissions"
                            {{ in_array($permission->id, $selectedPermissions) ? 'checked' : '' }}
                        >
                        <label class="form-check-label" for="permission-{{ $permission->id }}">
                            {{ $permission->name }}
                        </label>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-3">
            <button type="submit" class="btn btn-primary">Save Permissions</button>
        </div>
    </form>
</div>
