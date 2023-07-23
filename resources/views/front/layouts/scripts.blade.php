<script src="{{ asset('assets/front/') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/front/') }}/js/all.min.js"></script>
<script src="{{ asset('assets/front/') }}/js/jquery-1.10.1.min.js"></script>
<script src="{{ asset('assets/front/') }}/js/owl.carousel.min.js"></script>
<script src="{{ asset('assets/front/') }}/js/plugin.js"></script>
<script src="{{ asset('assets/front/') }}/js/main.js"></script>
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
    $(document).ready(function() {
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

<script>
    $( function() {
        $( "#datepicker").datepicker();
    } );
</script>


<script>
    function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 22.3038945, lng: 70.80215989999999},
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

        autocomplete.addListener('place_changed', function() {
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

<script>
    // Add By Ajax
    $(document).on('submit','Form#addForm',function(e) {
        e.preventDefault();
        let url = $('#addForm').attr('action');
        let datePicker = $("#datepicker").val();
        let title = $("#title").val();
        let image = $("#image").val();
        let sur_name = $("#sur_name").val();
        let address = $("#searchMapInput").val();
        let latitude = $("#lat-span").val();
        let longitude = $("#lng-span").val();
        let has_qrcode = $("#flexRadioDefault1").val();

        $.ajax({

            url: url,
            type: 'POST',
            enctype : 'multipart/form-data',
            data: {
                "_token" : "{{csrf_token()}}",
                "date" : datePicker,
                "title": title,
                "image" : image,
                "sur_name": sur_name,
                "address" : address,
                "longitude": longitude,
                "latitude": latitude,
                "has_qrcode": has_qrcode,
            },
            beforeSend: function () {
                $('#addButton').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                    ' ></span> <span style="margin-left: 4px;">working</span>').attr('disabled', true);
            },

            success: function (data) {
                if (data.status == 200) {
                    toastr.success('تم اضافه الدعوه بنجاح');
                }
                else
                    toastr.error('There is an error');
                $('#addButton').html(`حفظ ومتابعة`).attr('disabled', false);
            },

            error: function (data) {
                if (data.status === 500) {
                    toastr.error('There is an error');
                } else if (data.status === 422) {

                    var errors = $.parseJSON(data.responseText);
                    $.each(errors, function (key, value) {
                        if ($.isPlainObject(value)) {
                            $.each(value, function (key, value){
                                toastr.error(value, key);
                            });
                        }
                    });
                } else
                    toastr.error('there in an error');
                $('#addButton').html(`حفظ ومتابعة`).attr('disabled', false);
            },//end error method

        });
    });
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK34ZyoH4758BkVP05-GxKP0dSmBi4yTo&libraries=places&callback=initMap" async defer></script>
@include('Admin/layouts/myAjaxHelper')
