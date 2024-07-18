@extends('dashboard.layouts.app')

@section('title')
Pejamas | Feedbacks
@endsection

@push('custom-css')
<style>
    .rate {
        border-bottom-right-radius: 12px;
        border-bottom-left-radius: 12px;
    }

    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center
    }

    .rating>input {
        display: none
    }

    .rating>label {
        position: relative;
        width: 1em;
        font-size: 30px;
        font-weight: 300;
        color: #FFD600;
        cursor: pointer
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0
    }

    .ratings{
        position: relative;
        width: 1em;
        font-size: 30px;
        font-weight: 300;
        color: #FFD600;
        cursor: pointer;
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important
    }

    .rating>input:checked~label:before {
        opacity: 1
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.4
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Feedbacks</h6>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="col-md-3 py-3" style="margin-top: -30px;">
                <form action="{{ route('dashboard.feedbacks.index') }}" method="GET">
                    <input class="form-control" type="search" value="{{ request()->query('search') }}" name="search" placeholder="Search" id="html5-search-input">
                </form>
            </div>
            <div class="card">
                <div class="card-top d-lg-lex">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-header">Data Feedbacks</h5>
                        @if (Auth::user()->role_id == 3)
                        <div class="button-add p-3" style="margin-right: 15px;">
                            <a href="javscript:void(0);" data-bs-target="#modalFeedbacks"
                            data-bs-toggle="modal" onclick="loadModal(`{{ $user_id }}`)" class="btn btn-primary d-grid text-white font-serif" target="_blank">Add Feedbacks</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                @if (Auth::user()->role_id == 1)
                                <th>Report</th>
                                <th>User</th>
                                <th>Status</th>
                                @endif
                                <th>Rating</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($feedbacks->count())
                                @foreach ($feedbacks as $key => $feedback)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    @if (Auth::user()->role_id == 1)
                                        <td>{{ $feedback->report->title }}</td>
                                        <td>{{ $feedback->user->name }}</td>
                                        <td>
                                            <form action="{{ route('dashboard.feedbacks.statusChange', ['id' => $feedback->id]) }}" method="POST" id="status-form">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input cursor-pointer" name="status"
                                                    onclick="event.preventDefault(); document.getElementById('status-form').submit();"
                                                    type="checkbox" {{ $feedback->status ? 'checked' : '' }} ">
                                                </div>
                                            </form>
                                        </td>
                                    @endif
                                    <td>
                                        <div class="rating">
                                            @for ($i = 0; $i < $feedback->rating; $i++)
                                                <input type="radio" checked ><label for="{{$i}}">☆</label>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>
                                        {{ $feedback->description }}
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
                                @if (Auth::user()->role_id == 1)
                                    <th>Report</th>
                                    <th>User</th>
                                    <th>Status</th>
                                @endif
                                <th>Rating</th>
                                <th>Description</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $feedbacks->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalFeedbacks" tabindex="-1" aria-hidden="true">
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
    function loadModal(userId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/feedbacks/modals/' + userId,
            success: function(response) {
                $("#loadModal").html(response);
                console.log(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
</script>
@endpush
