<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('front.layouts.head')

<body>
    @toastr_css
    @include('front.layouts.nav')

    @include('front.invites.components.contacts')

    <!-- Modal whatsapp -->
    @include('front.invites.components.whatsapp')

    <!-- Modal QR -->
    @include('front.invites.components.qr_code')

    @include('front.layouts.scripts')

    @toastr_js
    @toastr_render
</body>

</html>
