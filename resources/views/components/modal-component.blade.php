<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true" aria-labelledby="modalToggleLabel" style="display: none">
    @if($id == 'modalUsers')
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            @if(count($errors) > 0)
            {{ Session::reflash() }}
            @endif
            <div id="loadModal"></div>
        </div>
    </div>
    @else
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div id="loadModalVerify"></div>
        </div>
    </div>
    @endif
</div>
