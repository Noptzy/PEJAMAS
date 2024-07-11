@extends('dashboard.layouts.app')

@section('title')
Pejamas | Reports
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Reports</h4>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-file me-1"></i> Detail</a>
                </li>
                @if ($report)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.imageReport.index',['reportId' => $report->id]) }}"><i class="bx bx-file-blank me-1"></i> Supporting Document</a>
                </li>
                @endif
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Report Detail
                    @if($report?->status === 'review')
                        <span class="text-sm bg-label-warning">{{ $report?->status }}</span>
                    @elseif($report?->status === 'checking')
                        <span class="text-sm bg-label-secondary">{{ $report?->status }}</span>
                    @elseif($report?->status === 'proggress')
                        <span class="text-sm bg-label-info">{{ $report?->status }}</span>
                    @else
                        <span class="text-sm bg-label-success">{{ $report?->status }}</span>
                    @endif
                </h5>
                <hr class="my-0" />
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.reports.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">Title</label>
                                <input required
                                @if($report)
                                readonly
                                @endif
                                class="form-control" type="text" id="title" placeholder="Jalan Rusak" name="title" value="{{ $report->title ?? old('title') }}" autofocus />
                            </div>
                            <input required type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input required
                                @if($report)
                                readonly
                                @endif
                                class="form-control @error('address') is-invalid @enderror" type="text" id="address" placeholder="Jl. Soekarno Htta" name="address" value="{{ $report->address ?? old('address') }}" autofocus />
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="description" class="form-label">Description</label>
                                <textarea
                                @if($report)
                                readonly
                                @endif
                                class="form-control" type="text" id="description" name="description" autofocus />{{ $report->description ?? old('description') }}</textarea>
                            </div>
                            <div class="mb-3 col-md-6
                                @if($report)
                                d-none
                                @endif
                                ">
                                <label for="formFileMultiple" class="form-label">Supporting Document</label>
                                <input required
                                class="form-control" type="file" name="file[]" accept="image/*" id="formFileMultiple" multiple />
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="lat" class="form-label">Latitude</label>
                                        <input required
                                        @if($report)
                                        readonly
                                        @endif
                                        class="form-control numeric-only @error('lat') is-invalid @enderror" type="text" id="lat" name="lat" placeholder="69342324" value="{{ $report->lat ?? old('lat') }}" autofocus />
                                        @error('lat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="long" class="form-label">Longitude</label>
                                        <input required
                                        @if($report)
                                        readonly
                                        @endif
                                        class="form-control numeric-only @error('long') is-invalid @enderror" type="text" id="long" name="long" placeholder="129343" value="{{ $report->long ?? old('long') }}" autofocus />
                                        @error('long')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="state" class="form-label">State</label>
                                <input required
                                @if($report)
                                readonly
                                @endif
                                class="form-control" type="text" id="state" placeholder="Bandung" name="state" value="{{ $report->state ?? old('state') }}" autofocus />
                            </div>
                        </div>
                        <div class="mt-2">
                            @if($report)
                            <button type="reset" class="btn  btn-secondary me-2" disabled
                            >Save</button>
                            <a href="{{ route('dashboard.reports.index') }}" class="btn btn-outline-secondary">Back</a>
                            @else
                            <button type="submit" class="btn  btn-primary me-2"
                            >Save</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            @endif
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            function validateNumericInput(event) {
                const value = event.target.value;
                event.target.value = value.replace(/[^0-9.,-]/g, '');
            }

            document.querySelectorAll('input.numeric-only').forEach(input => {
                input.addEventListener('input', validateNumericInput);
            });
        });
    </script>
@endpush
