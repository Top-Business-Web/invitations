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
</head>
<body>

<div class="section">
    <div class="container d-flex justify-content-center">
        <div class="up-card mt-4 p-4 mb-4">
            <h5 class="text-center mb-4">المكرمة aya</h5>
            <img src="photo/blog2.jpg" class="w-100">
            <div class="d-flex justify-content-between mt-4">
                <button class="accept-btn">تأكيد</button>
                <button class="accept-btn reject-btn">رفض</button>
            </div>
            <textarea class="form-control mt-3" id="exampleFormControlTextarea1" rows="4" placeholder="ارسال رسالة الى الداعى"></textarea>
            <button class="send-btn mt-4">ارسال</button>
            <button class="send-btn mt-4 mb-4">موقع المناسبة</button>
        </div>
    </div>
</div>


{{--<script src="js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="js/all.min.js"></script>--}}
<script src="{{ asset('assets/front/') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/front/') }}/js/all.min.js"></script>
</body>
</html>
