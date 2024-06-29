<div class="modal-header">
    <h5 class="modal-title" id="modalToggleLabel">{{ $user->name }}</h5>
    @if (!$user->details)
        <span class="text-danger">(This user not completed their profile)</span>
    @endif
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="row">
        <div class="col-xl-12">
            <div class="nav-align-top">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-profile" aria-controls="navs-top-profile" aria-selected="true">
                            Profile
                        </button>
                    </li>
                    <li class="nav-item">
                        <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-top-identity" aria-controls="navs-top-identity" aria-selected="false">
                            Identity
                        </button>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="navs-top-profile" role="tabpanel">
                        <p class="mb-0">
                            Email : {{ $user->email }} <br>
                            Address : {{ $user->details?->complete_address ?? 'User not completed the profile' }} <br>
                            Phone : (+62) {{ $user->details?->phone ?? 'User not completed the profile' }} <br>
                            Gender : @if($user->details?->gender == 'L') Man @else Woman @endif
                        </p>
                    </div>
                    <div class="tab-pane fade" id="navs-top-identity" role="tabpanel">
                        <p class="mb-0">
                            Identity : {{ $user->details?->identity ?? 'User not completed the profile' }} <br>
                            Identity Card : <a href="{{ $user->details?->image_identity_url }}" target="_blank">Open File</a> <br>
                            Image : <img src="{{ $user->details?->image_url }}" class="img-fluid" style="width: 30%;" alt="{{ $user->name }}">
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <form action="{{ route('dashboard.users.declineAction', ['id' => $user->id]) }}" method="POST">
        @csrf
        <button class="btn btn-outline-danger">
            Decline
        </button>
    </form>

    <form action="{{ route('dashboard.users.verifyAction', ['id' => $user->id]) }}" method="POST">
        @csrf
        <input type="hidden" value="1" name="status">
        <button class="btn @if(!$user->details) btn-secondary @else btn-outline-primary @endif" type="submit" disabled="@if(!$user->details) true @endif">
            Apply
        </button>
    </form>
</div>
