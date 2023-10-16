<!DOCTYPE html>
<html lang="en" dir="ltr">

<!-- head included links and meta -->
@include('front.layouts.head')
<!-- head included links and meta -->

<body>
    <!-- Navabar start -->
    @include('front.layouts.nav')
    <!-- Navabar start -->

    <!-- Banner from index folder start -->
    @include('front.index.components.banner')
    <!-- Banner from index folder start -->

    <!-- invitation from index folder start -->
    @include('front.index.components.invitation')
    <!-- invitation from index folder start -->

    <!-- advantage from index folder start -->
    @include('front.index.components.advantage')
    <!-- advantage from index folder start -->

    <!-- client from index folder start -->
    @include('front.index.components.client')
    <!-- client from index folder start -->

    <!-- contact from index folder start -->
    @include('front.index.components.contact')
    <!-- contact from index folder start -->

    <!-- Footer -->
    @include('front.layouts.footer')
    <!-- Footer -->

    <!-- Scripts -->
    @include('front.layouts.scripts')
    <!-- Scripts -->


</body>

</html>
