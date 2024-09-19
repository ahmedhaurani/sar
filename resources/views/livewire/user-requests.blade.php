<div>
    <div class="w-full max-w-[85rem] py-10 px-4 sm:px-6 lg:px-8 mx-auto mt-5 mb-5">
        <div class="flex flex-col bg-white p-5 rounded mt-4 shadow-lg">
            <div class="-m-1.5 overflow-x-auto">
                <div class="p-1.5 min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <h3 class="text font-bold text-slate-500">الطلبات السابقة</h3>

                        @if($requests->isEmpty())
                            <div class="alert alert-info" role="alert">
                                لاتوجد طلبات سابقة.
                            </div>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>المستخدم</th>
                                        <th>القسم</th>
                                        <th>ملاحظات</th>
                                        <th>الحالة</th>
                                        <th>عرض التفاصيل</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($requests as $request)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $request->user->name }}</td>
                                            <td>{{ $request->department->name }}</td>
                                            <td>{{ $request->note }}</td>
                                            <td>
                                                <span class="badge
                                                    @switch($request->status)
                                                        @case('pending')
                                                            bg-warning text-dark
                                                            @break
                                                        @case('solved')
                                                            bg-success
                                                            @break
                                                        @case('rejected')
                                                            bg-danger
                                                            @break
                                                        @default
                                                            bg-secondary
                                                    @endswitch
                                                ">
                                                    {{ ucfirst($request->status) }}
                                                </span>
                                            </td>
                                            <td>
                                                <button wire:click="viewRequest({{ $request->id }})" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#requestModal">عرض</button>
                                            </td>
                                            <td>
                                                @if($request->admin_reply)
                                                    <span class="text-warning">&#9733;</span> <!-- Star icon or other indicator -->
                                                @else
                                                    <span class="text-muted">-</span> <!-- Placeholder if no reply -->
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Request Details -->
 <!-- Modal for Request Details -->
 <div wire:ignore.self class="modal fade" id="requestModal" tabindex="-1" aria-labelledby="requestModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestModalLabel">تفاصيل الطلب</h5>
                <button type="button" class="btn-close" wire:click="closeViewModal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body position-relative" style="min-height: 200px;">                <!-- Loading spinner -->
                <div wire:loading wire:target="viewRequest" class="position-absolute top-50 start-50 translate-middle py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">جاري التحميل...</span>
                    </div>
                </div>

                <!-- Request details content (hidden while loading) -->
                <div wire:loading.remove wire:target="viewRequest">
                    @if($selectedRequest)
                        <p><strong>رقم الطلب:</strong> {{ $selectedRequest->id }}</p>
                        <p><strong>المستخدم:</strong> {{ $selectedRequest->user->name }}</p>
                        <p><strong>القسم:</strong> {{ $selectedRequest->department->name }}</p>
                        <p><strong>ملاحظات:</strong> {{ $selectedRequest->note }}</p>
                        <p><strong>الحالة:</strong> {{ ucfirst($selectedRequest->status) }}</p>
                        @if($selectedRequest->admin_reply)
                            <p><strong>رد الإدارة:</strong></p>
                            <div class="alert alert-success border border-success p-3">
                                <strong>رد الإدارة:</strong> {{ $selectedRequest->admin_reply }}
                            </div>
                        @endif
                        @if(count($attachments) > 0)
                            <p><strong>المرفقات:</strong></p>
                            <ul>
                                @foreach($attachments as $attachment)
                                    <li><a href="{{ asset('storage/' . $attachment) }}" target="_blank">عرض الملف</a></li>
                                @endforeach
                            </ul>
                        @endif
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" wire:click="closeViewModal" data-bs-dismiss="modal">إغلاق</button>
            </div>
        </div>
    </div>
</div>

    @push('scripts')
    <script>
        document.addEventListener('livewire:load', function () {

            Livewire.on('show-modal', () => {
                $('#requestModal').modal('show');
                $('.modal').remove();
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
      $('body').removeAttr('style');
            });

            Livewire.on('close-modal', () => {
                $('#requestModal').modal('hide');
                $('.modal').remove();
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
      $('body').removeAttr('style');
            });
        });
    </script>
    @endpush
</div>
