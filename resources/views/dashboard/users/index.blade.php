@extends('dashboard.layouts.app')

@section('title')
Pejamas | Users
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Users</h6>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="col-md-3 py-3" style="margin-top: -30px;">
                <form action="{{ route('dashboard.users.index') }}" method="GET">
                    <input class="form-control" type="search" value="{{ request()->query('search') }}" name="search" placeholder="Search" id="html5-search-input">
                </form>
            </div>
            <div class="card">
                <div class="card-top d-lg-lex">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-header">Data Users</h5>
                        <div class="button-add p-3" style="margin-right: 15px;">
                            <a href="javascript::void(0);" class="btn btn-primary d-grid text-white font-serif"
                            data-bs-toggle="modal" data-bs-target="#modalUsers" onclick="userMethod(0,'crud')">Add User</a>
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
                                <th>Status</th>
                                <th>Account</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($users->count())
                            @foreach ( $users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><i class="fab fa-lg text-danger "></i> <strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <span class="badge
                                                    @if($user->role_id == 2) bg-label-secondary
                                                    @elseif($user->details?->status == 1) bg-label-secondary
                                                    @else bg-label-danger
                                                    @endif">
                                        @if($user->role_id == 2)
                                        verified
                                        @else
                                        {{ $user->details?->status_info ?? 'not verified' }}
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    {{ $user->details?->complete_address ?? '-' }}
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
                                            @if($user->details?->status == 0 && $user->role_id == 3)
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalVerify" onclick="userMethod(`{{ $user->id }}`, 'verify')"><i class="bx bx-check"></i>Verify</a>
                                            @endif
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalUsers" onclick="userMethod(`{{ $user->id }}`, 'crud')"><i class="bx bx-edit-alt"></i>Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete(`{{ $user->id }}`)"><i class="bx bx-trash"></i> Delete</a>
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('dashboard.users.destroy', $user->id) }}" method="POST" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center align-middle" colspan="100%">
                                    No User Data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot class="table-border-bottom-0">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Account</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $users->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@component('components.modal-component', [
    'id' => 'modalUsers'])
@endcomponent

@component('components.modal-component', [
    'id' => 'modalVerify'])
@endcomponent

@endsection

@push('custom-js')
<script>
    // load users modal
    function userMethod(userId, status) {

        if(status == 'crud')
        {
            $.ajax({
                type: 'GET',
                url: '/dashboard/users/' + userId,
                success: function(response) {
                    $("#loadModal").html(response);
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        else{
            $.ajax({
                type: 'GET',
                url: '/dashboard/users/verify/' + userId,
                success: function(response) {
                    $("#loadModalVerify").html(response);
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
    }
    // delete user
    function confirmDelete(userId) {
        document.getElementById('delete-form-' + userId).submit();
    }
</script>
@endpush
