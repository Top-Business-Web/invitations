<div class="modal fade" id="exampleModalQr" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="p-2">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center mt-3 mb-3 color2">{{ __('site.send_invitations_automatically_via_whatsApp') }}</h5>
                <p class="text-center mb-5 lh-lg">{{ __('site.undelivered_qr_codes_will_be') }}</p>
                <div class="d-flex justify-content-between mb-3">
                    <a href="#" class="text-decoration-none btn-login bg-hover" data-bs-dismiss="modal"
                        aria-label="Close">{{ __('site.cancellation') }}</a>
                    <button class="main-btn1 bg-hover">{{ __('site.send') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>
