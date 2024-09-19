<div class="container mt-3">
    @if (session('status'))
    <div class="alert alert-success">{{ session('status') }}</div>
@endif

@if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

    <div class="card" >

    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> الرجوع
            </a>
            <h3 class="mb-0">إضافة الصلاحيات والاذونات الى : {{ $role->name }}</h3>
        </div>


    <div class="row">
        <!-- Available Permissions Column -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Available Permissions</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group mt-2">
                        @foreach ($permissions as $permission)
                            @if (!in_array($permission->id, $selectedPermissions))
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $permission->name }}
                                    <button
                                        class="btn btn-primary btn-sm"
                                        wire:click="addPermission({{ $permission->id }})"
                                    >
                                        إضافة
                                    </button>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Assigned Permissions Column -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Assigned Permissions</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group mt-2">
                        @foreach ($permissions as $permission)
                            @if (in_array($permission->id, $selectedPermissions))
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $permission->name }}
                                    <button
                                        class="btn btn-danger btn-sm"
                                        wire:click="removePermission({{ $permission->id }})"
                                    >
                                        حذف
                                    </button>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
