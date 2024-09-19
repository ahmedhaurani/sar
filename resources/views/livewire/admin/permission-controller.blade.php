<div>
    <!-- Top Navigation Buttons -->
    <div class="container mt-5">
        <a href="{{ url('roles') }}" class="btn btn-outline-primary mx-1"><i class="fas fa-users"></i> Roles</a>
        <a href="{{ url('permissions') }}" class="btn btn-outline-info mx-1"><i class="fas fa-key"></i> Permissions</a>
        <a href="{{ url('users') }}" class="btn btn-outline-warning mx-1"><i class="fas fa-user"></i> Users</a>
    </div>

    <!-- Permission Table -->
    <div class="container mt-3">
        <!-- Status Alert -->
        @if (session('status'))
        <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert">
            <i class="fas fa-check-circle"></i> {{ session('status') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="card shadow-sm">


            <div class="card-header text-white d-flex justify-content-between align-items-center">

                <h4 class="mb-0"><i class="fas fa-key"></i> الصلاحيات والاذونات</h4>
                @can('create permission')
                <button wire:click="resetFields" data-bs-toggle="modal" data-bs-target="#permissionModal"
                    class="btn btn-light">
                    <i class="fas fa-plus-circle"></i> إضافة صلاحية جديدة
                </button>
                @endcan
            </div>
            <div class="card-body">

                <!-- Permissions Table -->
                <table class="table table-bordered table-striped mt-3">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th width="40%">الإجراء</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                        <tr>
                            <td>{{ $permission->id }}</td>
                            <td>{{ $permission->name }}</td>
                            <td>
                                @can('update permission')
                                <button wire:click="edit({{ $permission->id }})" class="btn btn-sm btn-success"
                                    data-bs-toggle="modal" data-bs-target="#permissionModal">
                                    <i class="fas fa-edit"></i> تعديل
                                </button>
                                @endcan

                                @can('delete permission')
                                <button wire:click="confirmDelete({{ $permission->id }})"
                                    class="btn btn-sm btn-danger mx-2" data-bs-toggle="modal"
                                    data-bs-target="#modalCenter">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permissionModalLabel">{{ $permissionId ? 'تعديل' : 'إضافة' }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="{{ $permissionId ? 'update' : 'store' }}">
                        <div class="mb-3">
                            <label for="name" class="form-label">اسم الصلاحيات</label>
                            <input type="text" wire:model="name" class="form-control"
                                placeholder="Enter permission name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">{{ $permissionId ? 'Update' : 'Create' }}
                                الصلاحيات</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCenterTitle">تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <p>هل انت متأكد من انك تريد حذف هذه الصلاحية ؟ </p>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">اغلاق</button>
                    <button type="button" class="btn btn-primary" wire:click="deleteConfirmed">حذف</button>
                </div>
            </div>
        </div>
    </div>

</div>

@push('scripts')
@script
<script>
    $wire.on('closeDeleteModal', () => {

      $('#deleteConfirmModal').modal('hide');
      $('.modal').remove();
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
      $('body').removeAttr('style');
    });

    $wire.on('closeUpdateModal', () => {

$('#permissionModal').modal('hide');
$('.modal').remove();
$('.modal-backdrop').remove();
$('body').removeClass('modal-open');
$('body').removeAttr('style');
});

</script>
@endscript

@endpush
