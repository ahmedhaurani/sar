<div class="container my-auto mt-5">
    @if (session('status'))
    <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert">
        <i class="fas fa-check-circle"></i> {{ session('status') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    {{-- @if (session('status'))
    <div class="alert alert-success mx-3 mt-2">{{ session('status') }}</div>
    @endif --}}
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4>Roles</h4>
            <a href="{{ route('roles.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> إضافة مجموعة
            </a>
        </div>



        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>الاجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @can('update role')
                            <a href="{{ route('roles.permissions', $role->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-user-shield"></i> اضافة وحذف صلاحيات
                            </a>

                            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-sm btn-success">
                                <i class="fas fa-edit"></i> تعديل
                            </a>
                            @endcan

                            @can('delete role')
                            <button wire:click="confirmDelete({{ $role->id }})" class="btn btn-sm btn-danger"
                                data-bs-toggle="modal"
                                data-bs-target="#modalCenter"
                                >
                                <i class="fas fa-trash"></i> حذف
                            </button>
                            <button wire:click="confirmDelete({{ $role->id }})"
                                class="btn btn-sm btn-danger mx-2" data-bs-toggle="modal"
                                data-bs-target="#deleteConfirmModal">
                                <i class="fas fa-trash"></i> حذفي
                            </button>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
       <!-- Modal -->
       <div wire:ignore.self class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmModalTitle">تأكيد الحذف</h5>
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
    // window.addEventListener('show-delete-modal', event => {
    //     $('#deleteConfirmModal').modal('show');
    // });

    // window.addEventListener('closeDeleteModal', event => {
    //     $('#deleteConfirmModal').modal('hide');
    //     $('.modal-backdrop').remove(); // Clean up the backdrop
    //     $('body').removeClass('modal-open');
    //     $('body').removeAttr('style');
    // });
//     $wire.on('show-delete-modal', () => {

// $('#deleteConfirmModal').modal('show');

// });


$wire.on('closeModal', () => {

$('#deleteConfirmModal').modal('hide');
$('.modal').remove();
$('.modal-backdrop').remove();
$('body').removeClass('modal-open');
$('body').removeAttr('style');
});

</script>
@endscript

@endpush
