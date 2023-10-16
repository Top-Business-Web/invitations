<div class="modal fade" id="modalWhatsApp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="p-2">
                <button type="button" class="btn-close" id="dismiss_modal" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 class="text-center mt-3 mb-3 color2">{{ __('site.send_invitations_automatically_via_whatsApp') }}</h5>
                <p class="text-center mb-5 lh-lg">{{ __('site.all_invitations_will_be') }}</p>
                <div class="d-flex justify-content-between mb-3">
                    <a href="#" class="text-decoration-none btn-login bg-hover" data-bs-dismiss="modal"
                        aria-label="Close">{{ __('site.cancellation') }}</a>
                    <button class="main-btn1 bg-hover sendWhatsApp">{{ __('site.save') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var sendWhatsAppButton = document.querySelector('.sendWhatsApp');
        var modalTriggerButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
        var modalParams = {};

        modalTriggerButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                modalParams.id = this.dataset.bsId;
            });
        });

        sendWhatsAppButton.addEventListener('click', function() {
            // alert(modalParams.id);
             sendParamToController(modalParams.id);
        });

        function sendParamToController(id) {
            // Create an AJAX request using fetch
            var invite_id = new URLSearchParams();
            invite_id.append('id', id);

            fetch('{{ route('sendInviteByWhatsapp') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                        'X-CSRF-Token': '{{ csrf_token() }}', // Include the CSRF token in the headers
                    },
                    body: invite_id
                })
                .then(function(response) {
                    if (response.status == "200") {
                        toastr.success('تم ارسال الدعوات بنجاح');
                        $("#dismiss_modal")[0].click();
                        // location.reload();
                    } else {
                        throw new Error('Request failed');
                    }
                })
                .then(function(data) {
                    // Handle the response from the controller if needed
                    console.log(data);
                })
                .catch(function(error) {
                    // Handle any error that occurred during the request
                    console.error(error);
                });
        }
    });
</script>
