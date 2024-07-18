<div class="modal-header">
    <h5 class="modal-title" id="modalCenterTitle">Add Feedback</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" action="{{ route('dashboard.feedbacks.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="modal-body">
        <div class="row">
            <div class="col-12 mb-3">
                <input type="hidden" value="{{ $userId }}" name="user_id">
                <label for="exampleDataList" class="form-label">Select Report</label>
                <input
                    class="form-control"
                    list="datalistOptions"
                    id="exampleDataList"
                    placeholder="Type to search..."
                    name="report_id"
                />
                <datalist id="datalistOptions">
                    @foreach ($reports as $report)
                        <option value="{{ $report->id }}">{{ $report->title }}</option>
                    @endforeach
                </datalist>
                @error('report_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-12 mb-3">
                <label for="file" class="form-label">Rating</label>
                <div class="rating">
                    <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label>
                    <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
                    <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label>
                    <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label>
                    <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
                </div>
            </div>
            <div class="col-12 mb-3">
                <label for="file" class="form-label">Description</label>
                <textarea class="form-control" name="description" /></textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
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
