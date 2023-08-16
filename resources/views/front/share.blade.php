<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dawaat</title>
    <link href="photo/logo.png" rel="icon" />
    <!-- bootstrap -->
{{--    <link rel="stylesheet" href="css/all.min.css">--}}
{{--    <link rel="stylesheet" href="css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{ asset('assets/front') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/front') }}/css/bootstrap.min.css">
    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&family=Jost:wght@200;300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        .up-card{
            max-width: 500px;
            box-shadow: 0 5px 10px rgb(1 1 1 / 10%);
            border-radius: 10px;
        }
        .up-card img{
            box-shadow: 0 5px 10px rgb(1 1 1 / 10%);
            border-radius: 10px;
            height: 300px;
        }
        .accept-btn{
            width: 100px;
            border: none;
            background-color: #34A853;
            border-radius: 5px;
            color: white;
        }
        .reject-btn{
            background-color: #EA4335;
        }
        .send-btn{
            width: 100%;
            background-color: #363637;
            border-radius: 5px;
            color: white;
            border: none;
            height: 40px;
        }
    </style>
    @toastr_css
</head>
<body>

<div class="section">
    <div class="container d-flex justify-content-center">
        <div class="up-card mt-4 p-4 mb-4">
        <input type="hidden" class="form-control" value="{{ $invitee->id }}" id="userId" />
        <input type="hidden" class="form-control" value="{{ $invitee->invitation->id }}" id="invitation_id" />
            <h5 class="text-center mb-4">المكرم/ة {{$invitee->name}}</h5>
            <img src="{{$invitation->image}}" class="w-100">
            <div class="d-flex justify-content-between mt-4">
                <button class="accept-btn">تأكيد</button>
                <button class="accept-btn reject-btn">رفض</button>
            </div>
            <textarea class="form-control mt-3" id="exampleFormControlTextarea1" rows="4" placeholder="ارسال رسالة الى الداعى"></textarea>
            <button class="send-btn sendMessage mt-4">ارسال</button>
            <a class="send-btn mt-4 mb-4" target="blank" href="http://maps.google.com/maps?q={{$invitation->longitude.','.$invitation->latitude}}">
            <button class="send-btn mt-4 mb-4">موقع المناسبة</button>
            </a>
        </div>
    </div>
</div>


<script src="{{ asset('assets/front/') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/front/') }}/js/all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@toastr_js
@toastr_render
<script>

 // Function to approve invitation
    $(document).ready(function() {
    $('.accept-btn').on('click', function() {
        var id = $('#userId').val(); // Assuming you have an input element with the ID "userId" to get the user's ID
        
        // Create an AJAX request
        $.ajax({
            type: 'POST', // Change this to the appropriate HTTP method
            url: '{{ route('user.changeStatus') }}', // Replace with the actual backend endpoint URL
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
            },
            success: function(response) {
                if(response.status == 200)
                toastr.success('تم تأكيد الدعوة')
            },
            error: function(error) {
                if(response.status == 405)
                toastr.success('هناك خطأ ما')
            }
        });
    });
});

 // Function to cancel invitation
    $(document).ready(function() {
    $('.reject-btn').on('click', function() {
        var id = $('#userId').val(); // Assuming you have an input element with the ID "userId" to get the user's ID
        
        // Create an AJAX request
        $.ajax({
            type: 'POST', // Change this to the appropriate HTTP method
            url: '{{ route('cancelInvitation') }}', // Replace with the actual backend endpoint URL
            data: {
                "_token": "{{ csrf_token() }}",
                id: id,
            },
            success: function(response) {
                if(response.status == 200)
                toastr.success('تم رفض الدعوة')
            },
            error: function(error) {
                if(response.status == 405)
                toastr.success('هناك خطأ ما')
            }
        });
    });
});

$(document).ready(function() {
    $(".sendMessage").click(function() {
        var userId = $("#userId").val();
        var InvitationId = $('#invitation_id').val();
        var message = $("#exampleFormControlTextarea1").val();

        if (message.trim() === "") {
            toastr.error('الرجاء إدخال نص الرسالة');
            return; // Exit the function if the message is empty
        }

// Function to send message by user
        $.ajax({
            url: '{{ route('sendMessage') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                user_id: userId,
                message: message,
                InvitationId: InvitationId
            },
            success: function(response) {
                if (response.status == 200) {
                    toastr.success('تم إرسال الرسالة');
                }
            },
            error: function(error) {
                if (error.status == 405) {
                    toastr.error('هناك خطأ ما');
                }
            }
        });
    });
});




</script>
</body>
</html>
