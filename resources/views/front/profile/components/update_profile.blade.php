<div class="section pt-5 pb-5">
    <div class="container">
        <div class="bg-white p-5">
            <form id="profileForm" action="{{ route('update_profile') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6 col-12">
                        <label class="form-label">{{ __('site.the_name') }} :</label>
                        <h3 class="main-btn3">{{ $profile->name }}</h3>
                        {{-- <input type="text" {{ $profile->google_id == null ? '' : 'disabled' }}
                            value="{{ $profile->name }}" name="name" class="form-control" required> --}}
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label">{{ __('site.email') }} :</label>
                        <h3 class="main-btn3">{{ $profile->email }}</h3>
                        {{-- <input type="text" {{ $profile->google_id == null ? '' : 'disabled' }}
                            value="{{ $profile->email }}" name="email" class="form-control" required> --}}
                    </div>
                    <div class="col-md-6 col-12" {{ $profile->google_id == null ? '' : 'hidden' }}>
                        <label class="form-label"> {{ __('site.the_address') }} :</label>
                        <h3 class="main-btn3">{{ $profile->address }}</h3>
                        {{-- <input type="text" name="address" value="{{ $profile->address }}" class="form-control"> --}}
                    </div>
                    <div class="col-md-6 col-12" {{ $profile->google_id == null ? '' : 'hidden' }}>
                        <label class="form-label"> {{ __('site.phone') }} :</label>
                        <h3 class="main-btn3">{{ $profile->phone }}</h3>
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
                            <button type="button" class="main-btn2 bg-hover">
                                {{ __('site.points') }}: <span style="margin-right: 8px;">{{ $profile->points }}</span>
                            </button>
                            {{-- <button type="button" class="main-btn1 bg-hover" id="updateProfile"> حفظ</button> --}}
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
