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
