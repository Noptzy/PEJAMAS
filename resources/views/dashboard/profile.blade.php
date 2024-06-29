@extends('dashboard.layouts.app')

@section('title')
Pejamas | Account
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
<div class="row px-3">
    <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
            <div class="card mb-4">
                <h5 class="card-header">Profile Details
                    @if($user->role_id == 3)
                        @if($user->details?->status)
                            <span class="text-primary font-light">( {{ $user->details?->status_info }} )</span>
                        @else
                            <span class="text-danger font-light">( {{ $user->details?->status_info }} )</span>
                        @endif
                    @endif
                </h5>
                <!-- Account -->
                <form id="formAccountSettings" method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ $user->details?->image_url ?? asset('backend/img/avatars/profile.png') }}"
                            alt="user-avatar"
                            class="d-block rounded"
                            height="100"
                            width="100"
                            id="uploadedAvatar" />
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                    <span class="d-none d-sm-block">Upload new photo</span>
                                    <i class="bx bx-upload d-block d-sm-none"></i>
                                    <input type="file" id="upload" name="image" class="account-file-input d-none" accept="image/*" />
                                </label>
                                <button type="button" class="btn btn-outline-secondary account-image-reset mb-4">
                                    <i class="bx bx-reset d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Reset</span>
                                </button>
                                <p class="@error('image') text-danger @else text-muted @enderror mb-0">
                                    @error('image')
                                        {{ $message }}
                                    @else
                                        Allowed JPG, GIF or PNG. Max size of 800K
                                    @enderror
                                </p>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" value="{{ $user->name ?? old('name') }}" autofocus />
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input class="form-control @error('email') is-invalid @enderror" type="text" id="email" value="{{ $user->email ?? old('email') }}" readonly placeholder="john.doe@example.com" />
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="identity_number" class="form-label">Identity Number</label>
                                    <input class="form-control @error('identity') is-invalid @enderror" type="text" id="identity" name="identity" value="{{ $user->details->identity ?? old('identity') }}" placeholder="32xxxxxxxx" autofocus />
                                    @error('identity')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="formFile" class="form-label">Identity Card</label>
                                    @if($user->details?->identity_image)
                                        <a href="{{ $user->details?->image_identity_url }}" target="_blank">Open File</a>
                                    @endif
                                    @if ($user->details?->status == 1)
                                        <input class="form-control @error('identity_image') is-invalid @enderror" disabled type="file" name="identity_image" id="formFile" />
                                    @else
                                        <input class="form-control @error('identity_image') is-invalid @enderror" type="file" name="identity_image" id="formFile" />
                                    @endif
                                    @error('identity_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="role" class="form-label">Role</label>
                                    <input type="text" class="form-control" id="role" name="role" readonly value="{{ $user->roles->role }}" />
                                </div>
                                <div class="mb-3 col-md-6">
                                <label for="genderSelect" class="form-label">Gender</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="genderSelect" name="gender" aria-label="Default select example">
                                        <option disabled selected>Select</option>
                                        <option value="L" @selected($user->details?->gender == 'L')>Man</option>
                                        <option value="P" @selected($user->details?->gender == 'P')>Woman</option>
                                    </select>
                                    @error('gender')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="phone">Phone Number</label>
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">ID (+62)</span>
                                        <input type="text" id="phone" name="phone" value="{{ $user->details->phone ?? old('phone') }}" class="form-control @error('phone') is-invalid @enderror" placeholder="8xxxxxxx" />
                                        @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $user->details->address ?? old('address') }}" placeholder="Address" />
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="state" class="form-label">State</label>
                                    <input class="form-control @error('state') is-invalid @enderror" type="text" id="state" name="state" value="{{ $user->details->state ?? old('state') }}"  placeholder="Bandung" />
                                    @error('state')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="zip_code" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control @error('zip_code') is-invalid @enderror" id="zip_code" name="zip_code" value="{{ $user->details->zip_code ?? old('zip_code') }}" placeholder="231465" maxlength="6" />
                                    @error('zip_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-2">
                                <button type="submit" class="btn btn-primary me-2">Save changes</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                    </div>
                </form>
            <!-- /Account -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
    <script src="{{ asset('backend/js/pages-account-settings-account.js') }}"></script>
@endpush
