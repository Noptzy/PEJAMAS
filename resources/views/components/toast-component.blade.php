
<div class="bs-toast toast toast-placement-ex m-2 fade top-0 end-0
    @if ($errors->any()) bg-danger @else bg-success @endif
    @if($errors->any() || session('success')) show @else hidden @endif"
    role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
    <div class="toast-header">
        <i class="bx bx-bell me-2"></i>
        <div class="me-auto fw-semibold">{{ $type }}</div>
        <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        {{ $message }}
    </div>
</div>
