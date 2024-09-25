<div class="container mt-5 d-flex justify-content-center">
    <div class="card shadow-lg" style="max-width: 500px;">
        <div class="card-body text-center">
            <!-- Icon or Visual -->
            <div class="mb-4">
                <i class="bi bi-exclamation-triangle text-warning" style="font-size: 48px;"></i>
            </div>

            <!-- Title and Message -->
            <h5 class="card-title mb-3">تأكيد الحذف</h5> <!-- Confirm Deletion -->
            <p class="card-text">هل أنت متأكد أنك تريد حذف هذا الطلب؟ لا يمكن التراجع عن هذا الإجراء.</p> <!-- Are you sure you want to delete this request? This action cannot be undone. -->

            <!-- Buttons for Delete and Cancel -->
            <div class="d-grid gap-2 d-md-block">
                <button wire:click="deleteRequest" class="btn btn-danger px-4">حذف</button> <!-- Delete -->
                <a href="{{ route('admin.requests') }}" class="btn btn-secondary px-4">إلغاء</a> <!-- Cancel -->
            </div>
        </div>
    </div>
</div>
