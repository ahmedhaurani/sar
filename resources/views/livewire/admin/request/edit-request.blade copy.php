<div>
    <div class="container mt-5">
        <!-- Page Title -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">تعديل حالة الطلب <!-- Edit Request Status in Arabic --></h3>
            </div>

            <div class="card-body">
                <!-- Update Status Form -->
                <form wire:submit.prevent="updateStatus">
                    <!-- Status Field -->
                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة <!-- Status in Arabic --></label>
                        <select wire:model="status" class="form-control">
                            <option value="">اختر الحالة <!-- Select Status in Arabic --></option>
                            <option value="pending">قيد الانتظار <!-- Pending in Arabic --></option>
                            <option value="solved">محلول <!-- Solved in Arabic --></option>
                            <option value="rejected">مرفوض <!-- Rejected in Arabic --></option>
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Note Field -->
                    <div class="mb-3">
                        <label for="note" class="form-label">ملاحظة <!-- Note in Arabic --></label>
                        <textarea wire:model="note" class="form-control" rows="4" placeholder="أضف ملاحظة (اختياري)"></textarea> <!-- Add a note (optional) in Arabic -->
                        @error('note') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Update Button -->
                    <button type="submit" class="btn btn-success">تحديث الحالة <!-- Update Status in Arabic --></button>

                    <!-- Back Button -->
                    <a href="{{ route('admin.requests') }}" class="btn btn-secondary mt-3">العودة إلى الطلبات <!-- Back to Requests in Arabic --></a>
                </form>
            </div>
        </div>
    </div>
</div>
