<div>
    <div class="container mt-5">
        <!-- Page Title -->
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">تعديل حالة الطلب</h3> <!-- Edit Request Status in Arabic -->
            </div>

            <div class="card-body">
                <!-- Update Status Form -->
                <form wire:submit.prevent="updateStatus">
                    <!-- Status Field -->
                    <div class="mb-3">
                        <label for="status" class="form-label">الحالة</label> <!-- Status in Arabic -->
                        <select wire:model="status" class="form-control">
                            <option value="">اختر الحالة</option> <!-- Select Status in Arabic -->
                            <option value="pending">قيد الانتظار</option> <!-- Pending in Arabic -->
                            <option value="solved">محلول</option> <!-- Solved in Arabic -->
                            <option value="rejected">مرفوض</option> <!-- Rejected in Arabic -->
                        </select>
                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Admin Reply Field -->
                    <div class="mb-3">
                        <label for="adminReply" class="form-label">رد الإدارة</label> <!-- Admin Reply in Arabic -->
                        <textarea wire:model="adminReply" class="form-control" rows="4" placeholder="أضف رد الإدارة (اختياري)"></textarea> <!-- Add admin reply (optional) in Arabic -->
                        @error('adminReply') <span class="text-danger">{{ $message }}</span> @enderror
                    </div>

                    <!-- Attached Files -->
                    @if($attachments)
                        <div class="mb-3">
                            <label class="form-label">الملفات المرفقة</label> <!-- Attached Files in Arabic -->
                            <ul>
                                @foreach($attachments as $attachment)
                                    <li>
                                        <a href="{{ asset('storage/'.$attachment) }}" target="_blank" class="btn btn-sm btn-primary">
                                            عرض الملف <!-- View File in Arabic -->
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Update Button -->
                    <button type="submit" class="btn btn-success">تحديث الحالة</button> <!-- Update Status in Arabic -->

                    <!-- Back Button -->
                    <a href="{{ route('admin.requests') }}" class="btn btn-secondary mt-3">العودة إلى الطلبات</a> <!-- Back to Requests in Arabic -->
                </form>
            </div>
        </div>
    </div>
</div>
