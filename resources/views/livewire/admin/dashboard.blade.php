<div class="content-wrapper">

    <div class="container mt-5 flex-grow-1 ">
        <h1 class="mb-4 text-center"></h1>

        <div class="row justify-content-center">


            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-primary h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-primary"><i class="bx bxs-user"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $userCount }}</h4>
                        </div>
                        <p class="mb-1">عدد المشتركين</p>
                        {{-- <p class="mb-0">
                            <span class="fw-medium me-1">+18.2%</span>
                            <small class="text-muted">than last week</small>
                        </p> --}}
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-danger h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-danger"><i
                                        class="bx bx-list-ul"></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $requestCount }}</h4>
                        </div>
                        <p class="mb-1">عدد الطلبات</p>
                        <p class="mb-0">
                            <span class="fw-medium me-1">{{ $requestCount }}</span>
                            <small class="text-muted">عدد الطلبات الكلية</small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-warning h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-warning"><i
                                        class='bx bx-time-five'></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $requestPendingCount }}</h4>
                        </div>
                        <p class="mb-1">قيد الانتظار</p>
                        <p class="mb-0">
                            <span class="fw-medium me-1">{{ $requestPendingCount }}</span>
                            <small class="text-muted">عدد الطلبات قيد الانتظار</small>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-info h-100">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2">
                                <span class="avatar-initial rounded bg-label-info"><i
                                        class='bx bxs-analyse'></i></span>
                            </div>
                            <h4 class="ms-1 mb-0">{{ $visitorCount }}</h4>
                        </div>
                        <p class="mb-1">عدد الزوار</p>
                        <p class="mb-0">
                            <span class="fw-medium me-1">{{ $visitorCount }}</span>
                            <small class="text-muted">عدد الزوار اخر 24 ساعة</small>
                        </p>
                    </div>
                </div>
            </div>
        </div>



    </div>
</div>
