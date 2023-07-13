<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('front.layouts.head')

<body>
    @include('front.layouts.my_nav')

    @include('front.invites.components.contacts')

    <!-- Modal whatsapp -->
    @include('front.invites.components.whatsapp')

    <!-- Modal QR -->
    @include('front.invites.components.qr_code')

    @include('front.layouts.scripts')

</body>

</html>
