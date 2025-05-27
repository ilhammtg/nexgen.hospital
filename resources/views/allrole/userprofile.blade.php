@extends('allrole.allrole-master')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Header -->
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 p-4">
                    <div
                        class="user-profile-header d-flex flex-column flex-lg-row text-sm-start text-center align-items-center">
                        <div class="flex-shrink-0">
                            @php
                                $userImage =
                                    !empty($data->image) &&
                                    file_exists(public_path('storage/user-image/' . $data->image))
                                        ? asset('storage/user-image/' . $data->image)
                                        : 'https://ui-avatars.com/api/?name=' .
                                            urlencode($data->name) .
                                            '&background=0D8ABC&color=fff';
                            @endphp
                            <img src="{{ $userImage }}" alt="Foto Profil {{ $data->name }}"
                                class="rounded-circle user-profile-img"
                                style="width: 100px; height: 100px; object-fit: cover;" />
                        </div>

                        <div class="flex-grow-1 mt-3 mt-lg-0 ms-lg-4">
                            <div
                                class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                                <div class="user-profile-info text-center text-lg-start">
                                    <h4 class="mb-2">{{ $data->name }}</h4>
                                    <ul
                                        class="list-inline mb-0 d-flex flex-wrap justify-content-center justify-content-lg-start gap-3">
                                        <li class="list-inline-item d-flex gap-2 align-items-center">
                                            <i class="ti ti-map-pin ti-lg"></i><span class="fw-medium">Indonesia</span>
                                        </li>
                                        <li class="list-inline-item d-flex gap-2 align-items-center">
                                            <i class="ti ti-calendar ti-lg"></i><span
                                                class="fw-medium">{{ $tanggalJoin }}</span>
                                        </li>
                                    </ul>
                                </div>
                                {{-- Tambahkan tombol di sini jika dibutuhkan --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!--/ Header -->

        <!-- Navbar pills -->
        <div class="row">
            <div class="col-md-12">
                <div class="nav-align-top">
                    <ul class="nav nav-pills flex-column flex-sm-row mb-6 gap-2 gap-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"><i
                                    class="ti-sm ti ti-user-check me-1_5"></i> Profile</a>
                        </li>
                        {{-- <li class="nav-item">
                        <a class="nav-link" href="pages-profile-teams.html"
                          ><i class="ti-sm ti ti-users me-1_5"></i> Teams</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages-profile-projects.html"
                          ><i class="ti-sm ti ti-layout-grid me-1_5"></i> Projects</a
                        >
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="pages-profile-connections.html"
                          ><i class="ti-sm ti ti-link me-1_5"></i> Connections</a
                        >
                      </li> --}}
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Navbar pills -->

        <!-- User Profile Content -->
        <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-5">
                <!-- About User -->
                <div class="card mb-6">
                    <div class="card-body">
                        <small class="card-text text-uppercase text-muted small">About</small>
                        <ul class="list-unstyled my-3 py-1">
                            <li class="d-flex align-items-center mb-4">
                                <i class="ti ti-user ti-lg"></i><span class="fw-medium mx-2">Full Name:</span>
                                <span>{{ $data->name }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-4">
                                <i class="ti ti-check ti-lg"></i><span class="fw-medium mx-2">Verify at:</span>
                                <span>{{ $tanggalJoin }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-4">
                                <i class="ti ti-crown ti-lg"></i><span class="fw-medium mx-2">Role:</span>
                                <span>{{ $data->role }}</span>
                            </li>
                        </ul>
                        <small class="card-text text-uppercase text-muted small">Contacts</small>
                        <ul class="list-unstyled my-3 py-1">
                            <li class="d-flex align-items-center mb-4">
                                <i class="ti ti-phone-call ti-lg"></i><span class="fw-medium mx-2">Contact:</span>
                                <span>(+62) {{ $data->phone }}</span>
                            </li>
                            <li class="d-flex align-items-center mb-4">
                                <i class="ti ti-mail ti-lg"></i><span class="fw-medium mx-2">Email:</span>
                                <span>{{ $data->email }}</span>
                            </li>
                        </ul>

                    </div>
                </div>
                <!--/ About User -->
                <!-- Profile Overview -->

                <!--/ Profile Overview -->
            </div>
            <div class="col-xl-8 col-lg-7 col-md-7">
                <!-- Activity Timeline -->
                <div class="card card-action mb-6">
                    <div class="card-header align-items-center">
                        <h5 class="card-action-title mb-0">
                            <i class="ti ti-chart-bar ti-lg text-body me-4"></i>Activity Timeline
                        </h5>
                    </div>
                    <div class="card-body pt-3">
                        <ul class="timeline mb-0">
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-primary"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-3">
                                        <h6 class="mb-0">12 Invoices have been paid</h6>
                                        <small class="text-muted">12 min ago</small>
                                    </div>
                                    <p class="mb-2">Invoices have been paid to the company</p>
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="badge bg-lighter rounded d-flex align-items-center">
                                            <img src="{{ asset('/assets') }}//img/icons/misc/pdf.png" alt="img"
                                                width="15" class="me-2" />
                                            <span class="h6 mb-0 text-body">invoices.pdf</span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-success"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-3">
                                        <h6 class="mb-0">Client Meeting</h6>
                                        <small class="text-muted">45 min ago</small>
                                    </div>
                                    <p class="mb-2">Project meeting with john @10:15am</p>
                                    <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                                        <div class="d-flex flex-wrap align-items-center mb-50">
                                            <div class="avatar avatar-sm me-3">
                                                <img src="{{ asset('/assets') }}/img/avatars/1.png" alt="Avatar"
                                                    class="rounded-circle" />
                                            </div>
                                            <div>
                                                <p class="mb-0 small fw-medium">Lester McCarthy (Client)</p>
                                                <small>CEO of Pixinvent</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-item timeline-item-transparent">
                                <span class="timeline-point timeline-point-info"></span>
                                <div class="timeline-event">
                                    <div class="timeline-header mb-3">
                                        <h6 class="mb-0">Create a new project for client</h6>
                                        <small class="text-muted">2 Day Ago</small>
                                    </div>
                                    <p class="mb-2">6 team members in a project</p>
                                    <ul class="list-group list-group-flush">
                                        <li
                                            class="list-group-item d-flex justify-content-between align-items-center flex-wrap border-top-0 p-0">
                                            <div class="d-flex flex-wrap align-items-center">
                                                <ul
                                                    class="list-unstyled users-list d-flex align-items-center avatar-group m-0 me-2">
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" title="Vinnie Mostowy"
                                                        class="avatar pull-up">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('/assets') }}/img/avatars/1.png"
                                                            alt="Avatar" />
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" title="Allen Rieske"
                                                        class="avatar pull-up">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('/assets') }}/img/avatars/4.png"
                                                            alt="Avatar" />
                                                    </li>
                                                    <li data-bs-toggle="tooltip" data-popup="tooltip-custom"
                                                        data-bs-placement="top" title="Julee Rossignol"
                                                        class="avatar pull-up">
                                                        <img class="rounded-circle"
                                                            src="{{ asset('/assets') }}/img/avatars/2.png"
                                                            alt="Avatar" />
                                                    </li>
                                                    <li class="avatar">
                                                        <span class="avatar-initial rounded-circle pull-up text-heading"
                                                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="3 more">+3</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--/ Activity Timeline -->
                <div class="row">
                    <!-- Connections -->

                    <!--/ Connections -->
                    <!-- Teams -->

                    <!--/ Teams -->
                </div>
                <!-- Projects table -->

                <!--/ Projects table -->
            </div>
        </div>
        <!--/ User Profile Content -->
    </div>
    <!-- / Content -->
@endsection
