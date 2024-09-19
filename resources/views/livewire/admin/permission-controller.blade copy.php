<div>
    <div class="container mt-5">
        <a href="{{ url('roles') }}" class="btn btn-primary mx-1">Roles</a>
        <a href="{{ url('permissions') }}" class="btn btn-info mx-1">Permissions</a>
        <a href="{{ url('users') }}" class="btn btn-warning mx-1">Users</a>
    </div>

    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card mt-3">
                    <div class="card-header">
                        <h4>Permissions
                            @can('create permission')
                            <button wire:click="resetFields" data-bs-toggle="modal" data-bs-target="#permissionModal" class="btn btn-primary float-end">Add Permission</button>
                            @endcan
                        </h4>
                    </div>
                    <div class="card-body">

                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th width="40%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->id }}</td>
                                    <td>{{ $permission->name }}</td>
                                    <td>
                                        @can('update permission')
                                        <button wire:click="edit({{ $permission->id }})" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#permissionModal">Edit</button>
                                        @endcan

                                        @can('delete permission')
                                        <button wire:click="delete({{ $permission->id }})" class="btn btn-danger mx-2">Delete</button>
                                        @endcan
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                <!-- Modal -->
                <div wire:ignore.self class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="permissionModalLabel">{{ $permissionId ? 'Edit Permission' : 'Add Permission' }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form wire:submit.prevent="{{ $permissionId ? 'update' : 'store' }}">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Permission Name</label>
                                        <input type="text" wire:model="name" class="form-control" placeholder="Enter permission name">
                                        @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">{{ $permissionId ? 'Update' : 'Create' }} Permission</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
