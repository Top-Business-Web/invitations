<!DOCTYPE html>
<html>
<!-- head included links and meta -->
@include('front.layouts.head')
<!-- head included links and meta -->

<body>

    <!-- Navabar start -->
    @include('front.layouts.nav')
    <!-- Navabar start -->

    @yield('content')

    <!-- Footer start -->
    @include('front.layouts.footer')
    <!-- Footer start -->

    <!-- Script start -->
    @include('front.layouts.scripts')
    <!-- Script start -->
</body>

</html>
