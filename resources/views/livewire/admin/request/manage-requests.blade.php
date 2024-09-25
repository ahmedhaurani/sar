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
           <!-- Search and Filter Form -->
           <div class="row mb-4">
            <div class="col-md-4">
                <input type="text" wire:model.live="searchTerm" class="form-control" placeholder="ابحث بالاسم أو رقم الهاتف"> <!-- Search by name or phone -->
            </div>
            <div class="col-md-4">
                <select wire:model.live="statusFilter" class="form-control">
                    <option value="">كل الحالات</option> <!-- All statuses -->
                    <option value="pending">معلق</option> <!-- Pending -->
                    <option value="solved">تم الحل</option> <!-- Solved -->
                    <option value="rejected">مرفوض</option> <!-- Rejected -->
                </select>
            </div>
        </div>
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
                                    <a href="{{ route('requests.edit', $request->id) }}" class="btn btn-sm btn-warning">
                                        عرض <!-- Edit -->
                                    </a>

                                    <!-- Delete Button with Confirmation -->
                                    <a href="{{ route('admin.requests.confirm-delete', $request->id) }}" class="btn btn-sm btn-danger mx-2">
                                        حذف <!-- Delete -->
                                    </a>
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
