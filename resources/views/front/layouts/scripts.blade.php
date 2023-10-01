<script src="{{ asset('assets/front/') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/front/') }}/js/all.min.js"></script>
<script src="{{ asset('assets/front/') }}/js/jquery-1.10.1.min.js"></script>
<script src="{{ asset('assets/front/') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('assets/front/') }}/js/plugin.js"></script>
@if (app()->getLocale() == 'ar')
    <script src="{{ asset('assets/front/') }}/js/main.js"></script>
@else
    <script src="{{ asset('assets/front/') }}/js/main_en.js"></script>
@endif
<script src="{{ asset('assets/front/') }}/js/dropify.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Include toastr JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<!-- start style of date picker -->
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<link rel="stylesheet" href="/resources/demos/style.css">


<!-- Include toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
<script>
    $(document).ready(function () {
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",

        };
    });
</script>
<script>
    $('.dropify').dropify();
</script>

<!-- start script of date picker -->
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>


{{-- datepicker--}}
<script>
    $(function () {
        $("#datepicker").datepicker();
    });
</script>

{{-- Find the closest <tr> element relative to the clicked delete button and remove it--}}
<script>
    $(document).ready(function () {
        // Add a click event handler for the delete button with the class "delete-table"
        $(".delete-table").click(function () {
            // Find the closest <tr> element relative to the clicked delete button and remove it
            $(this).closest('tr').remove();
        });
    });
</script>


{{-- map js--}}
<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {
                lat: 22.3038945,
                lng: 70.80215989999999
            },
            zoom: 13
        });
        var input = document.getElementById('searchMapInput');
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

        var autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
            map: map,
            anchorPoint: new google.maps.Point(0, -29)
        });

        autocomplete.addListener('place_changed', function () {
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();

            /* If the place has a geometry, then present it on a map. */
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);
            }
            marker.setIcon(({
                url: place.icon,
                size: new google.maps.Size(71, 71),
                origin: new google.maps.Point(0, 0),
                anchor: new google.maps.Point(17, 34),
                scaledSize: new google.maps.Size(35, 35)
            }));
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }

            infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
            infowindow.open(map, marker);

            /* Location details */
            document.getElementById('location-snap').value = place.formatted_address;
            document.getElementById('lat-span').value = place.geometry.location.lat();
            document.getElementById('lng-span').value = place.geometry.location.lng();


        });
    }
</script>


{{-- localStorage.clear();--}}
<script>
    $(document).on('click', '.createBtnInivite', function () {
        localStorage.clear();
    });
</script>


{{-- all methods js oprations --}}
<script>
    // validate input
    $(document).ready(function () {
        // Function to check all input fields and enable/disable the button accordingly
        function toggleButtonState() {
            var allFieldsFilled = true;

            $('.input-field').each(function () {
                if ($(this).val().trim() === '') {
                    allFieldsFilled = false;
                    return false; // Exit the loop early if any field is empty
                }
            });
            $('#step1Btn').prop('disabled', !allFieldsFilled);
        }

        // Check the input fields on page load
        toggleButtonState();

        // Check the input fields when typing in any of them
        $('.input-field').on('input', function () {
            toggleButtonState();
        });
    });

    // show image
    $(document).ready(function () {
        // When a file is selected using the input field
        $("#image").change(function () {
            var file = this.files[0];
            if (file) {
                var imageURL = URL.createObjectURL(file);
                $(".imagePreview").attr("src", imageURL);
            }
        });
    });

    // declare vars
    var datePicker = localStorage.getItem('datePicker');
    var title = localStorage.getItem('title');
    var sur_name = localStorage.getItem('sur_name');
    var address = localStorage.getItem('address');
    var latitude = localStorage.getItem('latitude');
    var longitude = localStorage.getItem('longitude');
    var has_qrcode = localStorage.getItem('has_qrcode');

    // take vars token values
    $("#datepicker").val(datePicker);
    $("#title").val(title);
    $("#sur_name").val(sur_name);
    $("#searchMapInput").val(address);
    $("#lat-span").val(latitude); // Assuming these are not input elements, use .text() instead of .val()
    $("#lng-span").val(longitude); // Assuming these are not input elements, use .text() instead of .val()
    $("#flexRadioDefault1").prop('checked', has_qrcode); // Assuming this is a checkbox input
    $("#invition_title").text(title);
    $(".titlePreview").text(title);
    if (datePicker != null && title != null && sur_name != null &&
        address != null && latitude != null && longitude != null &&
        has_qrcode != null) {
        @if(app()->getLocale() == 'ar')
        $("#div1").css('margin-right', '-25%');
        @else
        $("#div1").css('margin-left', '-25%');
        @endif
    }


    // ----------------------------------------------------------------
    // start add
    // ----------------------------------------------------------------

    // ----------------------
    // start step 1 add
    // ----------------------
    $(document).on('click', '#step1Btn', function () {

        var datePicker = $("#datepicker").val();
        var title = $("#title").val();
        var image = $('#image')[0].files[0]; // new eldapour edition
        var sur_name = $("#sur_name").val();
        var address = $("#searchMapInput").val();
        var latitude = $("#lat-span").val();
        var longitude = $("#lng-span").val();
        var has_qrcode = $("#flexRadioDefault1").val();
        $("#invition_title").text(title);
        $(".titlePreview").text(title);
        // first step value declare
        localStorage.setItem('datePicker', datePicker);
        localStorage.setItem('title', title);
        localStorage.setItem('image', image);
        localStorage.setItem('sur_name', sur_name);
        localStorage.setItem('address', address);
        localStorage.setItem('latitude', latitude);
        localStorage.setItem('longitude', longitude);
        localStorage.setItem('has_qrcode', has_qrcode);

        $('.titlePreview').val(title);


    });
    // ----------------------
    // end step 1 add
    // ----------------------

    // ----------------------
    //  start step 2 add
    // ----------------------
    $(document).on('click', '#step2Btn', function () {

        var url = '{{ route('addInvitationByClient') }}';
        var invitees_phone = $('.invitees_phone');
        var invitees_id = $('.invitees_id');
        var invitees_name = $('.invitees_name');
        var invitees_email = $('.invitees_email');
        var invitees_number = $('.invitees_number');

        let phone_list = [];
        let id_list = [];
        let name_list = [];
        let email_list = [];
        let number_list = [];

        invitees_phone.each(function () {
            phone_list.push($(this).val());
        });

        invitees_id.each(function () {
            id_list.push($(this).val());
        });
        invitees_name.each(function () {
            name_list.push($(this).val());
        });

        invitees_email.each(function () {
            email_list.push($(this).val());
        });
        invitees_number.each(function () {
            number_list.push($(this).val());
        });
        // first step value declare
        var datePicker = localStorage.getItem('datePicker');
        var title = localStorage.getItem('title');
        var image = localStorage.getItem('image');
        var sur_name = localStorage.getItem('sur_name');
        var address = localStorage.getItem('address');
        var latitude = localStorage.getItem('latitude');
        var longitude = localStorage.getItem('longitude');
        var has_qrcode = localStorage.getItem('has_qrcode');

        var contactArray = name_list.map((value, index) => {
            return {
                'id': id_list[index],
                'name': value,
                'email': email_list[index],
                'phone': phone_list[index],
                'number': number_list[index]
            };
        });

        // console.log(contactArray);

        console.log({
            'url': url,
            'datePicker': datePicker,
            'title': title,
            'image': image,
            'sur_name': sur_name,
            'address': address,
            'latitude': latitude,
            'longitude': longitude,
            'has_qrcode': has_qrcode,
            'contactArray': contactArray,
        })

        var imageFile = $('#image')[0].files[0];

        var serviceValue = [];
        $('.services:checked').each(function () {
            serviceValue.push($(this).val());
        })

        var formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('image', imageFile);
        formData.append('datePicker', datePicker);
        formData.append('title', title);
        formData.append('sur_name', sur_name);
        formData.append('address', address);
        formData.append('latitude', latitude);
        formData.append('longitude', longitude);
        formData.append('has_qrcode', has_qrcode);
        formData.append('status', 1);
        formData.append('check_contact', serviceValue);


        for (var i = 0; i < contactArray.length; i++) {
            formData.append('contactArray[' + i + '][id]', contactArray[i]['id']);
            formData.append('contactArray[' + i + '][name]', contactArray[i]['name']);
            formData.append('contactArray[' + i + '][email]', contactArray[i]['email']);
            formData.append('contactArray[' + i + '][phone]', contactArray[i]['phone']);
            formData.append('contactArray[' + i + '][number]', contactArray[i]['number']);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // Show loading spinner or do something before sending the request
            },
            success: function (data) {
                // Handle the successful response from the server

                if (data.status == 409) {
                    toastr.error('يرجي اضافه المزيد من الدعوات بواسطه الادمن');

                } else {

                    toastr.success('تم انشاء الدعوة بنجاح');
                }
                setTimeout(function () {
                    location.href = '{{ route('invites') }}';
                })
            },
            error: function (error) {
                // Handle errors in the request
                toastr.error('هناك خطا ما حاول في وقت لاحق');
            },
            complete: function () {
                // Do something after the request is completed, regardless of success or error
            }
        });

        {{--// send whatsapp--}}
        {{--$.ajax({--}}
        {{--    type: 'POST',--}}
        {{--    url: "{{ url('api/send_invite_by_whatsapp') }}",--}}
        {{--    data: formData,--}}
        {{--    processData: false,--}}
        {{--    contentType: false,--}}
        {{--    success: function(data) {--}}
        {{--        toastr.success('تم ارسال الدعوات بنجاح');--}}
        {{--        console.log(data);--}}
        {{--    },--}}
        {{--});--}}

    });
    // ----------------------
    // end step 2 add
    // ----------------------

    // ----------------------------------------------------------------
    // end add
    // ----------------------------------------------------------------


    // ----------------------------------------------------------------
    // start draft
    // ----------------------------------------------------------------
    $(document).on('click', '#addDraftInvite', function () {

        var url = '{{ route('addDraft') }}'
        var datePicker = $("#datepicker").val();
        var title = $("#title").val();
        var imageFile = $('#image')[0].files[0]; // new edition image file
        var sur_name = $("#sur_name").val();
        var address = $("#searchMapInput").val();
        var latitude = $("#lat-span").val();
        var longitude = $("#lng-span").val();
        var has_qrcode = $("#flexRadioDefault1").val();
        var id = $('input[name="id"]').val();

        // declare in data source
        var formData = new FormData();
        formData.append('datePicker', datePicker);
        formData.append('title', title);
        formData.append('image', imageFile);
        formData.append('sur_name', sur_name);
        formData.append('address', address);
        formData.append('latitude', latitude);
        formData.append('longitude', longitude);
        formData.append('has_qrcode', has_qrcode);
        formData.append('status', 0);
        formData.append('id', id);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // Show loading spinner or do something before sending the request dddddd
            },
            success: function (data) {
                // Handle the successful response from the server
                toastr.success('تم انشاء الدعوة بنجاح كمسودة');
                setTimeout(function () {
                    location.href = '{{ route('invites') }}';
                })
            },
            error: function (error) {
                // Handle errors in the request
                toastr.error('هناك خطا ما حاول في وقت لاحق');
            },
            complete: function () {
                // Do something after the request is completed, regardless of success or error
            }
        })

    });
    // ----------------------------------------------------------------
    // end draft
    // ----------------------------------------------------------------


    // ----------------------------------------------------------------
    // start edit
    // ----------------------------------------------------------------

    // editBtnInvite
    $(document).on('click', '#editBtnInvite', function () {
        let id = $(this).data('id');
        let url = "{{ route('editInvitation', ':id') }}";
        url = url.replace(':id', id);
        window.location.href = url;
    })


    // ----------------------
    // start step 1 edit
    // ----------------------
    $(document).on('click', '#step1BtnEdit', function () {

        var datePicker = $("#datepicker").val();
        var id = $('input[name="id"]').val();
        var title = $("#title").val();
        var image = $('#image')[0].files[0]; // new eldapour edition
        var sur_name = $("#sur_name").val();
        var address = $("#searchMapInput").val();
        var latitude = $("#lat-span").val();
        var longitude = $("#lng-span").val();
        var has_qrcode = $("#flexRadioDefault1").val();
        $("#invition_title").text(title);
        $(".titlePreview").text(title);
        // first step value declare

        localStorage.setItem('datePicker', datePicker);
        localStorage.setItem('title', title);
        localStorage.setItem('image', image);
        localStorage.setItem('sur_name', sur_name);
        localStorage.setItem('address', address);
        localStorage.setItem('latitude', latitude);
        localStorage.setItem('longitude', longitude);
        localStorage.setItem('has_qrcode', has_qrcode);
        localStorage.setItem('id', id);

        $('.titlePreview').val(title);

    });
    // ----------------------
    // end step 1 edit
    // ----------------------

    // ----------------------
    //  start step 2 edit
    // ----------------------
    $(document).on('click', '#step2BtnEdit', function () {


        var datePicker = $("#datepicker").val();
        var id = $('input[name="id"]').val();
        var title = $("#title").val();
        var image = $('#image')[0].files[0]; // new eldapour edition
        var sur_name = $("#sur_name").val();
        var address = $("#searchMapInput").val();
        var latitude = $("#lat-span").val();
        var longitude = $("#lng-span").val();
        var has_qrcode = $("#flexRadioDefault1").val();
        $("#invition_title").text(title);
        $(".titlePreview").text(title);
        // first step value declare

        localStorage.setItem('datePicker', datePicker);
        localStorage.setItem('title', title);
        localStorage.setItem('image', image);
        localStorage.setItem('sur_name', sur_name);
        localStorage.setItem('address', address);
        localStorage.setItem('latitude', latitude);
        localStorage.setItem('longitude', longitude);
        localStorage.setItem('has_qrcode', has_qrcode);
        localStorage.setItem('id', id);

        $('.titlePreview').val(title);


        var url = '{{ route('editInvitationByClient') }}';
        var invitees_phone = $('.invitees_phone');
        var invitees_name = $('.invitees_name');
        var invitees_email = $('.invitees_email');
        var invitees_number = $('.invitees_number');

        let phone_list = [];
        let name_list = [];
        let email_list = [];
        let number_list = [];

        invitees_phone.each(function () {
            phone_list.push($(this).val());
        });
        invitees_name.each(function () {
            name_list.push($(this).val());
        });
        invitees_email.each(function () {
            email_list.push($(this).val());
        });
        invitees_number.each(function () {
            number_list.push($(this).val());
        });
        // first step value declare
        var datePicker = localStorage.getItem('datePicker');
        var title = localStorage.getItem('title');
        var image = localStorage.getItem('image');
        var sur_name = localStorage.getItem('sur_name');
        var address = localStorage.getItem('address');
        var latitude = localStorage.getItem('latitude');
        var longitude = localStorage.getItem('longitude');
        var has_qrcode = localStorage.getItem('has_qrcode');
        var id = localStorage.getItem('id');

        var contactArray = name_list.map((value, index) => {
            return {
                'name': value,
                'email': email_list[index],
                'phone': phone_list[index],
                'number': number_list[index]
            };
        });

        console.log({
            'url': url,
            'datePicker': datePicker,
            'title': title,
            'image': image,
            'sur_name': sur_name,
            'address': address,
            'latitude': latitude,
            'longitude': longitude,
            'has_qrcode': has_qrcode,
            'contactArray': contactArray
        })

        var imageFile = $('#image')[0].files[0];

        var formData = new FormData();
        formData.append('image', imageFile);
        formData.append('datePicker', datePicker);
        formData.append('title', title);
        formData.append('sur_name', sur_name);
        formData.append('address', address);
        formData.append('latitude', latitude);
        formData.append('longitude', longitude);
        formData.append('has_qrcode', has_qrcode);
        formData.append('status', 1);
        formData.append('id', id);

        for (var i = 0; i < contactArray.length; i++) {
            formData.append('contactArray[' + i + '][name]', contactArray[i]['name']);
            formData.append('contactArray[' + i + '][email]', contactArray[i]['email']);
            formData.append('contactArray[' + i + '][phone]', contactArray[i]['phone']);
            formData.append('contactArray[' + i + '][number]', contactArray[i]['number']);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            url: url,
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // Show loading spinner or do something before sending the request
            },
            success: function (data) {
                // Handle the successful response from the server
                toastr.success('تم تعديل الدعوة بنجاح');
                setTimeout(function () {
                    location.href = '{{ route('invites') }}';
                })
            },
            error: function (error) {
                // Handle errors in the request
                toastr.error('هناك خطا ما حاول في وقت لاحق');
            },
            complete: function () {
                // Do something after the request is completed, regardless of success or error
            }
        })

    });
    // ----------------------
    // end step 2 edit
    // ----------------------

    // ----------------------------------------------------------------
    // end edit
    // ----------------------------------------------------------------

    // ----------------------------------------------------------------
    // start reminder
    // ----------------------------------------------------------------
    $(document).on('click', '#reminderBtn', function () {

        let inputValues = [];
        let url = '{{ route('sendReminder') }}';
        let id = $('input[name="id"]').val();
        let reminderForm = new FormData();
        $('.userPhone').each(function () {
            if ($(this).is(':checked')) {
                inputValues.push($(this).val());
            }
        });
        reminderForm.append('id', id);
        let arrayLength = inputValues.length;
        for (let phone = 0; phone < arrayLength; phone++) {
            reminderForm.append('phone[]', inputValues[phone]);
        }

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            type: 'POST',
            url: url,
            data: reminderForm,
            processData: false,
            contentType: false,
            beforeSend: function () {
                // Show loading spinner or do something before sending the request
            },
            success: function (data) {
                // Handle the successful response from the server
                toastr.success('تم  ارسال التذكيرات بنجاح');
                {{--setTimeout(function () {--}}
                {{--    location.href = '{{ route('invites') }}';--}}
                {{--})--}}
            },
            error: function (error) {
                // Handle errors in the request
                toastr.error('هناك خطا ما حاول في وقت لاحق');
            },
            complete: function () {
                // Do something after the request is completed, regardless of success or error
            }
        })
    })
    // ----------------------------------------------------------------
    // end reminder
    // ----------------------------------------------------------------


    // ----------------------------------------------------------------
    // start guest template
    // ----------------------------------------------------------------
    $(document).on('submit', 'Form#guestForm', function (e) {
        var formData = new FormData(this);
        var url = $('#guestForm').attr('action');
        $.ajax({
            url: url,
            type: 'get',
            data: formData,
            success: function (data){
                console.log(data);
            }
        })
    });

    // ----------------------------------------------------------------
    // end guest template
    // ----------------------------------------------------------------



</script>
<script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK34ZyoH4758BkVP05-GxKP0dSmBi4yTo&libraries=places&callback=initMap"
    async defer></script>
@include('Admin/layouts/myAjaxHelper')
