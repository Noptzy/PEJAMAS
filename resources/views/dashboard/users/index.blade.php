@extends('dashboard.layouts.app')

@section('title')
Pejamas | Users
@endsection

@section('content')
@if ($message = Session::get('success'))
    <x-toast-component :bg="'bg-success'" :type="'Success'" :message="$message" />
@endif
@if ($errors->any())
    @foreach ($errors->all() as $key => $error)
        <x-toast-component :bg="'bg-danger'" :type="'Failed'" :message="$error" />
    @endforeach
@endif
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Users</h6>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="card">
                <div class="card-top d-lg-lex">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-header">Data Users</h5>
                        <div class="button-add p-3" style="margin-right: 15px;">
                            <a href="javascript::void(0);"
                            class="btn btn-primary d-grid text-white font-serif"
                            data-bs-toggle="modal"
                            data-bs-target="#modalUsers"
                            onclick="userMethod(0)">Add User</a>
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
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal"
                                            data-bs-target="#modalUsers" onclick="userMethod(`{{ $user->id }}`)"><i class="bx bx-edit-alt"></i>Edit</a>
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
                    <div class="d-flex justify-content-end">
                        {{ $users->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if(count($errors) > 0 || session('success'))
    {{ Session::reflash() }}
@endif
<div class="modal fade"
    id="modalUsers" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div id="loadModal"></div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script>
    // load users modal
    function userMethod(userId){
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
    // delete user sweetalert
    function confirmDelete(userId) {
        document.getElementById('delete-form-' + userId).submit();
    }
</script>
@endpush
