<div class="section pt-5 pb-5">
    <div class="container">
        <div class="bg-white p-5">
            <form id="profileForm" action="{{ route('update_profile') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6 col-12">
                        <label class="form-label">
                            <h4>{{ __('site.the_name') }} :</h4>
                        </label>                        
                        <strong class="main-btn3 fs-5">{{ $profile->name }}</strong>
                        {{-- <input type="text" {{ $profile->google_id == null ? '' : 'disabled' }}
                            value="{{ $profile->name }}" name="name" class="form-control" required> --}}
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label">
                            <h4>{{ __('site.email') }} :</h4>
                        </label>
                        <strong class="main-btn3 fs-5">{{ $profile->email }}</strong>
                        {{-- <input type="text" {{ $profile->google_id == null ? '' : 'disabled' }}
                            value="{{ $profile->email }}" name="email" class="form-control" required> --}}
                    </div>
                    <div class="col-md-6 col-12" {{ $profile->google_id == null ? '' : 'hidden' }}>
                        <label class="form-label">
                            <h4> {{ __('site.the_address') }} :</h4>
                        </label>
                        <strong class="main-btn3 fs-5">{{ $profile->address }}</strong>
                        {{-- <input type="text" name="address" value="{{ $profile->address }}" class="form-control"> --}}
                    </div>
                    <div class="col-md-6 col-12" {{ $profile->google_id == null ? '' : 'hidden' }}>
                        <label class="form-label">
                            <h4> {{ __('site.phone') }} :</h4>
                        </label>
                        <strong class="main-btn3 fs-5">{{ $profile->phone }}</strong>
                        {{-- <input type="text" value="{{ $profile->phone }}" name="phone" class="form-control"
                            required> --}}
                    </div>
                    <div class="col-12" {{ $profile->google_id == null ? 'hidden' : '' }}>
                        <span class="text-black-50">{{ __('site.register_by') }}</span>
                        <img src="{{ asset('assets/front') }}/photo/google.svg">
                    </div>
                    <div class="col-12 mt-4">
                        <div class="d-flex justify-content-between mb-3">
                            <a href="{{ route('invites') }}" class="text-decoration-none btn-login bg-hover"> {{ __('site.back') }}</a>
                            
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('assets/front/') }}/js/jquery-1.10.1.min.js"></script>
<script>
    $(document).ready(function() {
        $("#profileForm").on("click", "#updateProfile", function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: $('#profileForm').attr('action'),
                method: 'post',
                data: {
                    _token: "{{ csrf_token() }}",
                    'name': $('input[name="name"]').val(),
                    'email': $('input[name="email"]').val(),
                    'phone': $('input[name="phone"]').val(),
                    'address': $('input[name="address"]').val(),

                },
                success: function(response) {
                    if (response.status === 200) {
                        toastr.success('تم تحديث الملف الشخصي بنجاح');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        var errors = xhr.responseJSON.errors;
                        for (var key in errors) {
                            if (errors.hasOwnProperty(key)) {
                                var errorMessages = errors[key].join('<br>');
                                toastr.error(errorMessages);
                            }
                        }
                    } else {
                        toastr.error('An error occurred. Please try again later.');
                    }
                }
            });
        });
        // update
    });
</script>
