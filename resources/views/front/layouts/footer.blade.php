<div class="footer client pt-3 pb-3">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="index.html">
                <img class="image-logo" src="{{ asset($setting->logo) }}" alt="no logo">
            </a>
            <div class="text-white">
                Copyright © 2023 . All rights reserved.
            </div>
            <div>
                <div class="link-social">
                    <p class="text-white text-center">تابعنا</p>
                    <a class="text-decoration-none" href="{{ $setting->facebook }}">
                        <i class="fa-brands fa-facebook-f me-3"></i>
                    </a>
                    <a class="text-decoration-none" href="{{ $setting->youtube }}">
                        <i class="fa-brands fa-youtube me-3"></i>
                    </a>
                    <a class="text-decoration-none" href="mailto: {{ $setting->email }}">
                        <i class="fa-solid fa-envelope me-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

