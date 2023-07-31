<script src="{{asset('assets/admin')}}/assets/js/jquery-3.4.1.min.js"></script>
@toastr_js
@toastr_render
<script>
    function expand(lbl) {
        var elemId = lbl.getAttribute("for");
        document.getElementById(elemId).style.height = "45px";
        document.getElementById(elemId).classList.add("my-style");
        lbl.style.transform = "translateY(-45px)";
    }

    $("form#RegisterFormUser").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var url = $('#RegisterFormUser').attr('action');
        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            beforeSend: function () {
                $('#RegisterUser').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                    ' ></span> <span style="margin-left: 4px;">{{ __('site.wait') }} ..</span>').attr('disabled', true);

            },
            complete: function () {


            },
            success: function (data) {
                if (data == 200) {
                    toastr.success('{{ __('site.an_account_has_been_created') }}');
                    window.setTimeout(function () {
                        window.location.href = '/invites';
                    }, 1000);
                } else {
                    toastr.error('{{ __('site.wrong_login_information') }}');
                    $('#RegisterUser').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> {{__('site.login')}}`).attr('disabled', false);
                }

            },
            error: function (data) {
                if (data.status === 500) {
                    $('#RegisterUser').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> {{__('site.login')}}`)`).attr('disabled', false);
                    toastr.error(' {{ __('site.something_is_wrong') }}');
                } else if (data.status === 422) {
                    $('#RegisterUser').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> {{__('site.login')}}`)`).attr('disabled', false);
                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value) {
                                toastr.error(value);
                            });

                        } else {
                        }
                    });
                } else {
                    $('#loginButton').html(`<i id="lockId" class="fa fa-lock" style="margin-left: 6px"></i> {{__('site.login')}}`)`).attr('disabled', false);

                    toastr.error(' {{ __('site.something_is_wrong') }} ...');
                }
            },//end error method

            cache: false,
            contentType: false,
            processData: false
        });
    });

</script>
