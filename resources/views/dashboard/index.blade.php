@extends('dashboard.layouts.app')

@section('title')
Pejamas | Dashboard
@endsection

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-4 col-md-4 order-1">
            <div class="row">
                @if (Auth::user()->role_id == 1)
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bx bx-user-pin fs-1 text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{ route('dashboard.users.index') }}">View More</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Users</span>
                            <h3 class="card-title mb-2">{{ $users }}</h3>
                        </div>
                    </div>
                </div>
                @elseif(Auth::user()->role_id == 2)
                <div class="col-lg-6 col-md-12 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bx bx-user fs-1 text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{ route('dashboard.users.index') }}">View More</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Warga</span>
                            <h3 class="card-title mb-2">{{ $citizens }}</h3>
                        </div>
                    </div>
                </div>
                @else
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
