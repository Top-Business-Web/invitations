<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dawaat</title>
    <link href="photo/logo.png" rel="icon"/>
    <!-- bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/front/parcode') }}/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/front/parcode') }}/css/bootstrap.min.css">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&family=Jost:wght@200;300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>

    <style>
        .up-card {
            width: 500px;
            border: 2px solid black;
        }

        .entry-card {
            background-color: #FBDCC0;
            margin: 0px 10px;
            padding: 15px;
        }

        .bg {
            background-color: #FBDCC0;
            padding: 0px 15px;
        }
    </style>
</head>

<body>

<div class="section">
    <div class="container" style="height: 100vh; display: flex; justify-content:center;align-items: center;">
        <div class="up-card" id="content" style="background-color: white;">
            <div class="row">
                <div class="col-8 mt-4 mb-2">
                    <h5 class="text-center">يرجى ابراز الكود للدخول</h5>
                    <h5 class="text-center">Please show code to enter</h5>
                    <div class="d-flex justify-content-center">
                        {!! QrCode::size(200)->generate($invitation->qrcode) !!}
                    </div>
                </div>
                <div class="col-4">
                    <div class="entry-card mb-4">
                        <h5 class="text-center mb-4">بطاقة دخول شخصية</h5>
                        <h5 class="text-center">Entry code</h5>
                    </div>
                    <h5 class="text-center">Daawat</h5>
                    <h5 class="text-center">دعوات</h5>
                </div>
            </div>
            <div class="bg d-flex justify-content-between">
                <div class="d-flex align-items-center">
                    daawat.topbusiness.io
                </div>
                <div class="d-flex">
                    <span class="d-flex align-items-center fs-4 ms-2">{{ $invitess->invitees_number }}</span>
                    <h5>ضيوف <br> Guest </h5>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('assets/front/parcode') }}/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/front/parcode') }}/js/all.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.js"></script>
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/dom-to-image/2.6.0/dom-to-image.min.js"></script>--}}
<script>
    // Function to convert the div to an image and initiate download
    // function convertAndDownload() {
    //     const divElement = document.getElementById("content");
    //
    //     // Use dom-to-image to convert the div to an image
    //     domtoimage.toBlob(divElement)
    //         .then(function(blob) {
    //             // Create a temporary anchor element
    //             const link = document.createElement('a');
    //             link.href = URL.createObjectURL(blob);
    //             link.download = 'converted-image.png';
    //
    //             // Trigger the download
    //             link.click();
    //
    //             // Clean up the temporary anchor
    //             URL.revokeObjectURL(link.href);
    //         })
    //         .catch(function(error) {
    //             console.error('Error converting div to image:', error);
    //         });
    // }

    // Attach the conversion and download function to the window load event
    // window.addEventListener("load", convertAndDownload);

    function convertAndDownload() {
        const divToCapture = document.getElementById('content');

        // Use dom-to-image library to capture the div as an image
        domtoimage.toPng(divToCapture)
            .then(function (dataUrl) {
                // Create an HTML img element with the captured image
                const img = new Image();
                img.src = dataUrl;
                var id = '{{ $invitation->id }}';
                var phone = '{{ $invitess->phone }}';

                // Send the image data to Laravel for storage
                fetch('{{ route('save-image') }}', {
                    method: 'POST',
                    body: JSON.stringify({image: dataUrl, id: id, phone: phone}),
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Include Laravel CSRF token
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log(data.message);
                        window.location.href = 'https://wa.me/201003210436';
                    })
                    .catch(error => {
                        console.error('Error saving image:', error);
                    });
            })
            .catch(function (error) {
                console.error('Error capturing div as an image:', error);
            });
    };
    convertAndDownload();

</script>
</body>

</html>
