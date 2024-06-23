@extends('dashboard.layouts.app')

@section('title')
Pejamas | Users
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Users</h6>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible" role="alert">
                {{ $message }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card">
                <div class="card-top d-lg-lex">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-header">Data Users</h5>
                        <div class="button-add p-3" style="margin-right: 15px;">
                            <a  href="" class="btn btn-primary d-grid text-white font-serif">Add User</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><i class="fab fa-lg text-danger "></i> <strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    {{ $user->alamat }}
                                </td>
                                <td>
                                    <span class="badge
                                                @if($user->role_id == 2) bg-label-primary
                                                @else bg-label-secondary
                                                @endif">
                                        {{ $user->roles->role }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-edit-alt"></i> Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);"><i class="bx bx-trash"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-border-bottom-0">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom-js')
<script>
</script>
@endpush
