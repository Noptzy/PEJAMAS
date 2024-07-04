<div class="modal-header">
    <h5 class="modal-title" id="modalCenterTitle">{{$title}}</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<form method="POST" action="@if(!$user) {{ route('dashboard.users.store') }} @else {{ route('dashboard.users.update', $user->id) }} @endif">
@csrf
@if($user)
    @method('PUT')
@endif
<div class="modal-body">
    @if (!$user)
    <div class="row">
        <div class="col mb-3">
            <label for="nameWithTitle" class="form-label">Name</label>
            <input type="text" id="nameWithTitle" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ old('name') }}" placeholder="Enter Name" />
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Email</label>
            <input type="email" id="emailWithTitle" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ old('email') }}" placeholder="xxxx@xxx.xx" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">Roles</label>
            <select class="form-select" id="selectRole" name="role_id" required aria-label="Default select example">
                <option selected disabled>Select</option>
                @if(Auth::user()->role_id == 1)
                    <option value="2" @selected(old('role_id') == 2)>Petugas</option>
                    <option value="3" @selected(old('role_id') == 3)>Warga</option>
                @else
                    <option value="3" @selected(old('role_id') == 3)>Warga</option>
                @endif
            </select>
            @error('role_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    @else
    <div class="row">
        <div class="col mb-3">
            <label for="nameWithTitle" class="form-label">Name</label>
            <input type="text" id="nameWithTitle" name="name" class="form-control @error('name') is-invalid @enderror" required value="{{ $user->name ?? old('name') }}" placeholder="Enter Name" />
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="row g-2">
        <div class="col mb-0">
            <label for="emailWithTitle" class="form-label">Email</label>
            <input type="email" id="emailWithTitle" name="email" class="form-control @error('email') is-invalid @enderror" required value="{{ $user->email ?? old('email') }}" placeholder="xxxx@xxx.xx" />
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="col mb-0">
            <label for="dobWithTitle" class="form-label">Roles</label>
            <select class="form-select" id="selectRole" name="role_id" required aria-label="Default select example">
                <option disabled>Select</option>
                @if(Auth::user()->role_id == 1)
                    <option value="2" @selected($user->role_id == 2)>Petugas</option>
                    <option value="3" @selected($user->role_id == 3)>Warga</option>
                @else
                    <option value="3" @selected($user->role_id == 3)>Warga</option>
                @endif
            </select>
            @error('role_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    @endif
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary">
    @if(!$user)
        Save
    @else
        Save Changes
    @endif
    </button>
</div>
</form>
