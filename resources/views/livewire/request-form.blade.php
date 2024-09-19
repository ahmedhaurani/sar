<div class="container mt-4">

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card">
        <!-- Card Header (Optional) -->
        {{-- <div class="card-header">
            <h4 class="mb-0">Submit Your Request</h4>
        </div> --}}

        <!-- Card Body -->
        <div class="card-body">
            <form wire:submit.prevent="submitRequest">
                <!-- Parent Department Dropdown -->
                <div class="mb-4">
                    <label for="parentDepartment" class="form-label fw-bold">القســم</label>
                    <select wire:model.live="selectedParentDepartment" class="form-select" id="parentDepartment">
                        <option value="">اختر القسم</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                    @error('selectedParentDepartment')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Sub-Department Dropdown -->
                @if (!empty($subDepartments) && count($subDepartments) > 0)
                    <div class="mb-4">
                        <label for="subDepartment" class="form-label fw-bold">القسم الفرعي</label>
                        <select wire:model.live="selectedSubDepartment" class="form-select" id="subDepartment">
                            <option value="">اختر القسم الفرعي</option>
                            @foreach ($subDepartments as $subDepartment)
                                <option value="{{ $subDepartment->id }}">{{ $subDepartment->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedSubDepartment')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <!-- Sub-Sub-Department Dropdown -->
                @if (!empty($subSubDepartments) && count($subSubDepartments) > 0)
                    <div class="mb-4">
                        <label for="subSubDepartment" class="form-label fw-bold">اختر القسم الفرعي </label>
                        <select wire:model="selectedSubSubDepartment" class="form-select" id="subSubDepartment">
                            <option value="">اختر القسم الفرعي</option>
                            @foreach ($subSubDepartments as $subSubDepartment)
                                <option value="{{ $subSubDepartment->id }}">{{ $subSubDepartment->name }}</option>
                            @endforeach
                        </select>
                        @error('selectedSubSubDepartment')
                            <div class="text-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                @endif

                <!-- Phone Number Field -->
                <div class="mb-4">
                    <label for="phone_number" class="form-label fw-bold">رقم الهاتف</label>
                    <input wire:model="phone_number" type="text" class="form-control" id="phone_number">
                    @error('phone_number')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Request Title Field -->
                <div class="mb-4">
                    <label for="request_title" class="form-label fw-bold">عنوان الطلب</label>
                    <input wire:model="request_title" type="text" class="form-control" id="request_title">
                    @error('request_title')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Request Description Field -->
                <div class="mb-4">
                    <label for="request_description" class="form-label fw-bold">وصف الطلب</label>
                    <textarea wire:model="request_description" class="form-control" id="request_description" rows="3" placeholder="ادخل وصف الطلب"></textarea>
                    @error('request_description')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Note Field -->
                <div class="mb-4">
                    <label for="note" class="form-label fw-bold">الملاحظات</label>
                    <textarea wire:model="note" class="form-control" id="note" rows="3" placeholder="ادخل ملاحظاتك"></textarea>
                    @error('note')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="attachments" class="form-label fw-bold">الملفات المرفقة</label>
                    <input wire:model="attachments" type="file" class="form-control" id="attachments" multiple>
                    @error('attachments.*')
                        <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="d-grid gap-2 mb-3">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-paper-plane"></i> ارسال الطلب
                    </button>
                </div>
            </form>
        </div>

        <!-- Card Footer (Optional) -->
        <div class="card-footer text-center">
            <small class="text-muted">Thank you for your request!</small>
        </div>
    </div>
</div>
