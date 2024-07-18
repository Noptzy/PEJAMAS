@extends('dashboard.layouts.app')

@section('title')
Pejamas | Dashboard
@endsection

@push('custom-css')
<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js"></script>
<link href="https://api.tiles.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css" rel="stylesheet" />
<style>
    #map {
        width: 100%;
        height: 400px;
    }

    .marker-proggress {
        background-image: url('marker.png');
        background-size: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
    }

    .marker-done {
        background-image: url('marker-done.png');
        background-size: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="row">
                @if (Auth::user()->role_id == 1)
                <div class="col-lg-2 col-md-2 col-6 mb-4">
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
                <div class="col-lg-2 col-md-2 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bx bx-message-dots fs-1 text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{ route('dashboard.feedbacks.index') }}">View More</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Feedback</span>
                            <h3 class="card-title mb-2">{{ $feedbacks }}</h3>
                        </div>
                    </div>
                </div>
                @elseif(Auth::user()->role_id == 2)
                <div class="col-lg-2 col-md-2 col-6 mb-4">
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
                <div class="col-md-3 col-lg-3 order-0 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Report Statistics</h5>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" href="{{ route('dashboard.feedbacks.index') }}">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-column align-items-center gap-1">
                                    <h2 class="mb-2">{{ $allReports['all'] }}</h2>
                                    <span>Total Reports</span>
                                </div>
                                <div id="orderStatisticsChart"></div>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-check"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Done</h6>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $allReports['done'] }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-file-find"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Review</h6>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $allReports['review'] }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-timer"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Proggress</h6>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $allReports['proggress'] }}</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-xl-7 order-0 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2 mb-2">Map Report</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-md-3 col-lg-3 col-xl-3 order-0 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Report Statistics</h5>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                        <a class="dropdown-item" href="{{ route('dashboard.feedbacks.index') }}">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex flex-column align-items-center gap-1">
                                        <h2 class="mb-2">{{ $allReports['all'] }}</h2>
                                        <span>Total Reports</span>
                                    </div>
                                    <div id="orderStatisticsChart"></div>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-check"></i></span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Done</h6>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold">{{ $allReports['done'] }}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-file-find"></i></span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Review</h6>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold">{{ $allReports['review'] }}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-timer"></i></span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Proggress</h6>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold">{{ $allReports['proggress'] }}</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9 col-xl-9 order-0 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2 mb-2">Map Report</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('custom-js')
    <script>

        function statusColor(type) {
            switch(type) {
                case "done":
                    return "bg-label-success";
                    break;
                case "review":
                    return "bg-label-warning";
                    break;
                case "proggress":
                    return "bg-label-info";
                    break;
                default:
                    return "bg-label-secondary";
                    break;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
        mapboxgl.accessToken = 'pk.eyJ1IjoieG51eHV6ZGV2IiwiYSI6ImNseXFkdXAxNDA5Y2syanEwZmg3a3liYjgifQ.NptD4HYsiUQGTyKdQscaeg';

        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [107.5585664, -6.9106838],
            zoom: 8
        });

        var mapsData = @json($maps);

        mapsData.forEach(function(feature) {
            console.log(feature);
            var el = document.createElement('div');
            el.className = feature.status == 'done' ? 'marker-done' : 'marker-proggress';

            new mapboxgl.Marker(el)
                .setLngLat([feature.lat, feature.long])
                .setPopup(
                    new mapboxgl.Popup({ offset: 25 })
                    .setHTML(
                        `<h3 class="fs-4">${feature.title}</h3>
                        <span class="${statusColor(feature.status)}">${feature.status}</span>
                        <p>${feature.description}</p>`
                    )
                )
                .addTo(map);
        });
    });
    </script>
    @endpush
