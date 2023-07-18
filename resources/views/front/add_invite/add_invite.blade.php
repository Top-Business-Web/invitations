<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('front.layouts.head')

<body>
    @include('front.layouts.nav')

    <!-- invite Info -->
    @include('front.add_invite.components.invite_info')

    <!-- invite Excel-->
    @include('front.add_invite.components.invite_excel')

    @include('front.add_invite.components.invite_edit')

    @include('front.layouts.scripts')

    <script>
        $('.dropify').dropify();
    </script>

</body>

</html>
