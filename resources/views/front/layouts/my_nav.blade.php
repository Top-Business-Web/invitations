<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.html">
            <img class="image-logo" src="{{ asset('assets/front') }}/photo/logo2.png" alt="no logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse bg-white" id="navbarNavDropdown">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                        href="{{ route('invites') }}">{{ __('site.invitations') }}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page"
                        href="{{ route('contact.index') }}">{{ __('site.contacts') }}</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('site.my_account') }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <li><a class="dropdown-item" href="">{{ __('site.personal_file') }}</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="{{ route('user.logout') }}">{{ __('site.log_out') }}</a></li>
                    </ul>
                </li>
            </ul>
            <div class="dropdown" style="z-index: 100000;">
                <button class="btn-language dropdown-toggle text-black" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        @if (app()->getLocale() === $localeCode)
                            <img src="{{ asset('assets/front') }}/photo/{{ $localeCode }}.png">
                            {{ $properties['native'] }}
                        @endif
                    @endforeach
                </button>
                <ul class="dropdown-menu text-end" aria-labelledby="dropdownMenuButton1">
                    @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a class="dropdown-item btn-language btn-color"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                <img src="{{ asset('assets/front') }}/photo/{{ $localeCode }}.png">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</nav>
