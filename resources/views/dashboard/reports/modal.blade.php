@if($type == 'show')
<div class="modal-header">
    <h5 class="modal-title" id="modalCenterTitle">{{$data['image']->filename}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <img src="{{ asset('/assets/images/reports/'.$data['report']->title .'/'.$data['image']->filename) }}" class="img-fluid w-100">
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
</div>
@else
<div class="modal-header">
    <h5 class="modal-title" id="modalCenterTitle">Add Image</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" action="{{ route('dashboard.imageReport.store') }}" enctype="multipart/form-data">
@csrf
<div class="modal-body">
    <div class="row">
        <input type="hidden" value="{{ $data }}" name="report_id">
        <div class="col mb-3">
            <label for="file" class="form-label">Select Image</label>
            <input class="form-control" type="file" name="filename" accept="image/*" id="formFile" />
            @error('filename')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">
        Save
    </button>
</div>
</form>
@endif
