<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white">{{ $title }}</h5>
                <a href="" type="reset" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"
                        style="color: #ffffff;"></i></a>
            </div>
            <div class="modal-body">
                {{ $body }}
            </div>
        </div>
    </div>
</div>
