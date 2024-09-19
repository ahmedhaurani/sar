<div class="container mt-5">
    <!-- Success Message -->
    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
<div class="card">
    <div class="card-body">


    <!-- Create or Edit Governorate Form -->
    <div class="card shadow-sm mb-4 border-0">
        <div class="card-header bg-success text-white mb-3">
            <h5 class="mb-0">{{ $updateMode ? 'تعديل المحافظة' : 'اضافة محافظة جديدة' }}</h5>
        </div>
        <div class="card-body">
            <form wire:submit.prevent="{{ $updateMode ? 'update' : 'store' }}">
                <div class="form-group">
                    <label for="name">اسم المحافظة</label>
                    <input type="text" wire:model="name" class="form-control" id="name" placeholder="اسم المحافظة">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="slug">الاسم المختصر (Slug)</label>
                    <input type="text" wire:model="slug" class="form-control" id="slug" placeholder="الاسم المختصر">
                    @error('slug') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary mt-3">{{ $updateMode ? 'تعديل' : 'اضافة' }}</button>
                    @if ($updateMode)
                        <button type="button" class="btn btn-secondary mt-3" wire:click="resetInputFields">الغاء</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <!-- List of Governorates -->
    <div class="card shadow-sm border-0 mb-5">
        <div class="card-header bg-info text-white mb-3">
            <h5 class="mb-0">جميع المحافظات</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>الاسم</th>
                        <th>slug</th>
                        <th>الاجراء</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($governorates as $governorate)
                        <tr>
                            <td>{{ $governorate->id }}</td>
                            <td>{{ $governorate->name }}</td>
                            <td>{{ $governorate->slug }}</td>

                            <td>
                                <button wire:click="edit({{ $governorate->id }})" class="btn btn-warning btn-sm">تعديل</button>
                                <button wire:click="confirmDelete({{ $governorate->id }})"
                                    class="btn btn-sm btn-danger mx-2" data-bs-toggle="modal"
                                    data-bs-target="#confirmModal">
                                    <i class="fas fa-trash"></i> حذف
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header py text-white">
                    <h5 class="modal-title" id="confirmModalLabel"> تأكيد الحذف</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                </div>
                <div class="modal-body">
                  هل انت متأكد من انك تريد حذف محافظة  {{ $governorate->name }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">الغاء</button>
                    <button type="button" wire:click="delete" class="btn btn-danger" data-dismiss="modal">نعم</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>


@push('scripts')
@script
<script>
    $wire.on('openModal', () => {

      $('#confirmModal').modal('open');
      $('.modal').remove();
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
      $('body').removeAttr('style');
    });

    $wire.on('closeModal', () => {

$('#confirmModal').modal('hide');
$('.modal').remove();
$('.modal-backdrop').remove();
$('body').removeClass('modal-open');
$('body').removeAttr('style');
});

</script>
@endscript

@endpush
