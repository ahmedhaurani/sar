
<div class="container mt-4">
    <h2 class="mb-4">Departments</h2>

    @if ($departments->isEmpty())
        <div class="alert alert-info">
            No departments found. <a href="{{ route('admin.departments.add') }}" class="btn btn-link">Click here to add a new department.</a>
        </div>
    @else
        <div class="row">
            @foreach ($departments as $department)
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">{{ $department->name }}</h5>
                            <div class="mb-2">
                                @can('update department')
                                <a href="{{ url('admin/departments/edit/'.$department->id ) }}" class=" btn btn-sm btn-warning">Edit</a>
                                @endcan
                                <button wire:click="delete({{ $department->id }})" class="btn btn-sm btn-outline-danger">Delete</button>
                            </div>
                        </div>
                        @if ($department->children->isNotEmpty())
                            <div class="card-body">
                                <h6>Sub-departments:</h6>
                                <ul class="list-unstyled ms-3">
                                    @foreach ($department->children as $child)
                                        <li class="mb-2">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span>{{ $child->name }}</span>
                                                <div class="mb-2">
                                                    @can('update department')
                                                    <a href="{{ url('admin/departments/edit/'.$child->id ) }}" class="btn btn-sm btn-primary">Edit</a>
                                                    @endcan
                                                    <button wire:click="delete({{ $child->id }})" class="btn btn-sm btn-link text-danger">Delete</button>
                                                </div>
                                            </div>

                                            <!-- Nested sub-departments -->
                                            @if ($child->children->isNotEmpty())
                                                <ul class="list-unstyled ms-3">
                                                    @foreach ($child->children as $grandchild)
                                                        <li class="mb-2">
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <span>{{ $grandchild->name }}</span>
                                                                <div class="mb-2">
                                                                    @can('update department')
                                                                    <a href="{{ url('admin/departments/edit/'.$grandchild->id) }}" class="btn btn-sm btn-success">Edit</a>
                                                                    @endcan
                                                                    <button wire:click="delete({{ $grandchild->id }})" class="btn btn-sm btn-link text-danger">Delete</button>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('admin.departments.add') }}" class="btn btn-success mt-3">Add Department</a>
</div>

