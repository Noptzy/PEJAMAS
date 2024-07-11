<div class="modal-header">
    <h5 class="modal-title" id="modalChangeStatusTitle">{{ $report->title }}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form action="{{ route('dashboard.reports.update', ['report' => $report->id]) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="modal-body">
        <div class="row">
            <div class="col mb-3">
                <label for="nameWithTitle" class="form-label">Select Status</label>
                <select class="form-select" id="exampleFormControlSelect1" name="status" aria-label="Default select example">
                    <option selected disabled>Open this select menu</option>
                    <option value="review" @selected( $report->status == 'review')>Review</option>
                    <option value="checking" @selected( $report->status == 'checking')>Checking</option>
                    <option value="proggress" @selected( $report->status == 'proggress')>Proggress</option>
                    <option value="done" @selected( $report->status == 'done')>Done</option>
                </select>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Close
        </button>
        <button type="submit" class="btn btn-primary">Save changes</button>
    </div>
</form>
