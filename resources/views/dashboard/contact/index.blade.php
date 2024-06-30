@extends('dashboard.layouts.app')

@section('title')
Pejamas | Contact
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Contact</h6>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="col-md-3 py-3" style="margin-top: -30px;">
                <form action="{{ route('dashboard.contact') }}" method="GET">
                    <input class="form-control" type="search" value="{{ request()->query('search') }}" name="search" placeholder="Search" id="html5-search-input">
                </form>
            </div>
            <div class="card">
                <div class="card-top d-lg-lex">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-header">Data Contact</h5>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data->count())
                            @foreach ( $data as $key => $item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><i class="fab fa-lg text-danger "></i> <strong>{{ $item->name }}</strong></td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>
                                    {{ $item->message }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                           <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete(`{{ $item->id }}`)"><i class="bx bx-trash"></i> Delete</a>
                                            <form id="delete-form-{{ $item->id }}" action="{{ route('dashboard.contact.destroy', $item->id) }}" method="POST" style="display: none;">
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
                                    No Data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot class="table-border-bottom-0">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $data->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script>
    // delete user
    function confirmDelete(contactId) {
        document.getElementById('delete-form-' + contactId).submit();
    }
</script>
@endpush
