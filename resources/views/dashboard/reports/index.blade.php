@extends('dashboard.layouts.app')

@section('title')
Pejamas | Reports
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Reports</h6>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="col-md-3 py-3" style="margin-top: -30px;">
                <form action="{{ route('dashboard.reports.index') }}" method="GET">
                    <input class="form-control" type="search" value="{{ request()->query('search') }}" name="search" placeholder="Search" id="html5-search-input">
                </form>
            </div>
            <div class="card">
                <div class="card-top d-lg-lex">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-header">Data Reports</h5>
                        @if (Auth::user()->role_id == 3)
                        <div class="button-add p-3" style="margin-right: 15px;">
                            <a href="{{ route('dashboard.reports.create') }}" class="btn btn-primary d-grid text-white font-serif" target="_blank">Add Reports</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Address</th>
                                <th>Coordinate</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($reports->count())
                            @foreach ($reports as $key => $report)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><i class="fab fa-lg text-danger "></i> <strong>{{ $report->title }}</strong></td>
                                <td>{{ $report->description }}</td>
                                <td>
                                    <span class="badge
                                    @if($report->status == 'review')
                                        bg-label-warning
                                    @elseif($report->status == 'checking')
                                        bg-label-secondary
                                    @elseif($report->status == 'proggress')
                                        bg-label-info
                                    @else
                                        bg-label-success
                                    @endif">
                                        {{ $report->status }}
                                    </span>
                                </td>
                                <td>{{ $report->address }}</td>
                                <td>{{ $report->lat.','.$report->long }}</td>
                                <td>
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if(Auth::user()->role_id == 2)
                                        <a href="javascript:void(0);" class="dropdown-item"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalChangeStatus"
                                        onclick="changeStatus(`{{ $report->id }}`)"><i class="bx bx-edit-alt"></i>Change Status</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('dashboard.reports.create', ['reportId' => $report->id]) }}"><i class="bx bx-show"></i>Show</a>
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
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Address</th>
                                <th>Coordinate</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $reports->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalChangeStatus" tabindex="-1" aria-hidden="true">
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
    function changeStatus(reportId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/reports/show/' + reportId,
            success: function(response) {
                $("#loadModal").html(response);
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
    // delete user
    function confirmDelete(userId) {
        document.getElementById('delete-form-' + userId).submit();
    }
</script>
@endpush
