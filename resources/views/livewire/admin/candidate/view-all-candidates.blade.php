<div class="container">
    <!-- Filter Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header">
            <h5 class="mb-0">تصفية المرشحين</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Search by Name -->
                <div class="col-md-4">
                    <input type="text" wire:model.live="search" class="form-control" placeholder="البحث بالاسم...">
                </div>

                <!-- Governorate Filter -->
                <div class="col-md-4">
                    <select wire:model.live="selectedGovernorate" class="form-control">
                        <option value="">كل المحافظات</option>
                        @foreach ($governorates as $governorate)
                            <option value="{{ $governorate->id }}">{{ $governorate->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Per Page Selector -->
                {{-- <div class="col-md-4">
                    <select wire:model.live="perPage" class="form-control">
                        <option value="10">عرض 10</option>
                        <option value="20">عرض 20</option>
                        <option value="50">عرض 50</option>
                    </select>
                </div> --}}
            </div>
        </div>
    </div>

    <!-- Candidates Table Section -->
    <div class="card shadow-sm">
        <div class="card-header">
            <h5 class="mb-0">قائمة المرشحين</h5>
        </div>                                    <a href="{{ route('admin.candidates.create') }}" class="btn btn-info btn-sm">عرض</a>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>الصورة</th>
                            <th>الاسم</th>
                            <th>المحافظة</th>
                            <th>عدد الأصوات</th>
                            <th>الحالة</th>
                            <th>الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidates as $candidate)
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/'.$candidate->photo) }}" alt="صورة المرشح" class="img-thumbnail" style="width: 50px;">
                                </td>
                                <td>{{ $candidate->name }}</td>
                                <td>{{ $candidate->governorate->name ?? 'غير متوفر' }}</td>
                                <td>{{ $candidate->totalVotes }}</td>
                                <td>{{ $candidate->active ? 'نشط' : 'غير نشط' }}</td>
                                <td>
                                    <a href="{{ route('admin.candidates.edit', $candidate->id) }}" class="btn btn-warning btn-sm">تعديل</a>
                                    <a href="{{ route('admin.candidates.delete', $candidate->id) }}" class="btn btn-danger btn-sm">حذف</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination Links -->
            <div class="d-flex justify-content-center">
                {{ $candidates->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
</div>
