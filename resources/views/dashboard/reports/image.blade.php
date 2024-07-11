@extends('dashboard.layouts.app')

@section('title')
Pejamas | {{ $report->title }}
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard / Reports / </span> Images</h4>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.reports.create', ['reportId' => $report->id]) }}"><i class="bx bx-file me-1"></i> Detail</a>
                </li>
                @if ($report)
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('dashboard.imageReport.index',['reportId' => $report->id]) }}"><i class="bx bx-file-blank me-1"></i> Supporting Document</a>
                </li>
                @endif
            </ul>
            <div class="card">
                <div class="card-top d-lg-lex">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-header">Data Image {{ $report->title }}</h5>
                        @if (Auth::user()->role_id == 3 && $report->status == 'review')
                        <div class="button-add p-3" style="margin-right: 15px;">
                        <a href="javascript::void(0);" class="btn btn-primary d-grid text-white font-serif"
                        data-bs-toggle="modal" data-bs-target="#modalImage" onclick="imageMethod(`{{ $report->id }}`,'create')">Add Image</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Images</th>
                                <th>Address</th>
                                <th>Coordinate</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if($images->count())
                            @foreach ($images as $key => $image)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td class="w-25"><img src="{{ asset('assets/images/reports/'.$report->title.'/'.$image->filename) }}" class="img-fluid w-25" alt="{{ $image->filename }}"></td>
                                <td>{{ $report->address }}</td>
                                <td>{{ $report->lat.', '.$report->long }}</td>
                                <td>
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="javascript:void(0);" class="dropdown-item"
                                        data-bs-toggle="modal" data-bs-target="#modalImage" onclick="imageMethod(`{{$image->id}}`,'show')"><i class="bx bx-show"></i>Show</a>
                                        @if(Auth::user()->role_id == 3)
                                        <a href="javascript:void(0);" class="dropdown-item"
                                        data-bs-toggle="modal" data-bs-target="#modalImage" onclick="imageMethod(`{{$image->id}}`,'delete')"><i class="bx bx-trash"></i>Delete</a>
                                        <form id="delete-form-{{ $image->id }}" action="{{ route('dashboard.imageReport.destroy', $image->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
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
                                <th>Images</th>
                                <th>Address</th>
                                <th>Coordinate</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $images->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalImage" tabindex="-1" aria-hidden="true" aria-labelledby="modalToggleLabel" style="display: none">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="loadModal"></div>
        </div>
    </div>
</div>

@endsection

@push('custom-js')
<script>
// load users modal
function imageMethod(imageId, status) {
    if(status == 'create')
    {
        $.ajax({
            type: 'GET',
            url: '/dashboard/reports/image/show/' + 0 + '/' + imageId,
            success: function(response) {
                $("#loadModal").html(response);
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    else if(status == 'show'){
        $.ajax({
            type: 'GET',
            url: '/dashboard/reports/image/show/' + imageId + '/show',
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
        document.getElementById('delete-form-' + imageId).submit();
    }
}
</script>
@endpush
