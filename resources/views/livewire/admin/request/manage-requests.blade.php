<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header text-white">
            <h3 class="mb-0">إدارة الطلبات</h3> <!-- Manage Requests in Arabic -->
        </div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Table of Requests -->
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>رقم الطلب</th> <!-- Request ID -->
                            <th>القسم</th> <!-- Department -->
                            <th>عنوان الطلب</th> <!-- Request Title -->
                            <th>الحالة</th> <!-- Status -->
                            <th>الملاحظات</th> <!-- Notes -->
                            <th>الإجراء</th> <!-- Action -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->department->name }}</td>
                                <td>{{ $request->request_title }}</td>
                                <td>{{ ucfirst($request->status) }}</td>
                                <td>{{ $request->note }}</td>
                                <td>
                                    <!-- Edit Button -->
                                    <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-sm btn-success">
                                        تعديل <!-- Edit -->
                                    </a>

                                    <!-- Delete Button with Confirmation -->
                                    <button wire:click="confirmDelete({{ $request->id }})" class="btn btn-sm btn-danger mx-2">
                                        حذف <!-- Delete -->
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination (if applicable) -->
            <div class="d-flex justify-content-end">
                {{ $requests->links() }}
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div wire:ignore.self class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">تأكيد الحذف <!-- Confirm Deletion --></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    هل أنت متأكد أنك تريد حذف هذا الطلب؟ <!-- Are you sure you want to delete this request? -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء <!-- Cancel --></button>
                    <button type="button" wire:click="deleteRequest" class="btn btn-danger">حذف <!-- Delete --></button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add your JavaScript at the bottom of the file -->
@push('custom-scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        window.addEventListener('show-delete-confirmation', event => {
            var myModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            myModal.show();
        });

        window.addEventListener('close-modal', event => {
            var myModal = bootstrap.Modal.getInstance(document.getElementById('deleteModal'));
            if (myModal) {
                myModal.hide();
            }
        });
    });
</script>
@endpush
