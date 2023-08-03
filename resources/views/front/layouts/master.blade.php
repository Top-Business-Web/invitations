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


    <script type="module">
        // Import the functions you need from the SDKs you need
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-app.js";
        import { getAnalytics } from "https://www.gstatic.com/firebasejs/10.1.0/firebase-analytics.js";
        // TODO: Add SDKs for Firebase products that you want to use
        // https://firebase.google.com/docs/web/setup#available-libraries

        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        const firebaseConfig = {
            apiKey: "AIzaSyAuaYWB-m9mC2qb51shgieMTt-ZgNbWA-s",
            authDomain: "daawat-deac0.firebaseapp.com",
            projectId: "daawat-deac0",
            storageBucket: "daawat-deac0.appspot.com",
            messagingSenderId: "950480129606",
            appId: "1:950480129606:web:9342ea911426efa32dc447",
            measurementId: "G-898VMQN8EX"
        };

        // Initialize Firebase
        const app = initializeApp(firebaseConfig);
        const analytics = getAnalytics(app);
    </script>
</body>

</html>
