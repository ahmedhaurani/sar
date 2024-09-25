<div>
    <div class="container mt-5">
        <!-- Page Title -->
        <div class="card shadow-sm">
            <div class="card-header  text-white">
                <h3 class="mb-0">تعديل حالة الطلب</h3> <!-- Edit Request Status in Arabic -->
            </div>

            <div class="card-body">
                <!-- Display Request Details -->
                <div class="mb-3">
                    <label for="requestTitle" class="form-label">عنوان الطلب</label> <!-- Request Title in Arabic -->
                    <p class="form-control-plaintext">{{ $this->request_title }}</p> <!-- Display note as plain text -->
                </div>

                <div class="mb-3">
                    <label for="requestDescription" class="form-label">وصف الطلب</label> <!-- Request Description in Arabic -->
                    <p class="form-control-plaintext">{{ $this->request_description }}</p> <!-- Display note as plain text again -->
                </div>

                <div class="mb-3">
                    <label for="phoneNumber" class="form-label">رقم الهاتف</label> <!-- Phone Number in Arabic -->
                    <p class="form-control-plaintext">{{ $this->phone_number }}</p> <!-- Display phone number as plain text -->
                </div>

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

                <!-- Department Field -->
                <div class="mb-3">
                    <label for="department" class="form-label">القسم</label> <!-- Department in Arabic -->
                    <select wire:model="departmentId" class="form-control">
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('departmentId') <span class="text-danger">{{ $message }}</span> @enderror
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
                <button type="submit" wire:click="updateStatus" class="btn btn-success">تحديث الحالة</button> <!-- Update Status in Arabic -->

                <!-- Back Button -->
                <a href="{{ route('admin.requests') }}" class="btn btn-secondary ">العودة إلى الطلبات</a> <!-- Back to Requests in Arabic -->
            </div>
        </div>
    </div>
</div>
