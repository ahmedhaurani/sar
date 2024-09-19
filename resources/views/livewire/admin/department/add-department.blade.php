<div class="container mt-5" dir="rtl">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4 class="mb-0">إضافة قسم جديد</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show text-end" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <label for="name" class="form-label">اسم القسم</label>
                    <input type="text" id="name" wire:model="name" class="form-control" placeholder="أدخل اسم القسم" required>
                </div>

                <div class="mb-3">
                    <label for="parent_id" class="form-label">القسم الرئيسي</label>
                    <select id="parent_id" wire:model="parent_id" class="form-select">
                        <option value="">اختر القسم الرئيسي</option>
                        @foreach ($departments as $department)
                            @include('livewire.partials.admin.department-option', ['department' => $department])
                        @endforeach
                    </select>
                </div>

                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-success">إضافة القسم</button>
                </div>
            </form>
        </div>
    </div>
</div>
