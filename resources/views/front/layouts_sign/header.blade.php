<div class="image-shape">
    <div class="p-2">
        <div class="container d-flex justify-content-between align-items-center">
            <div class="link-header">
                <a class="text-decoration-none" href="{{ url('/') }}">
                    @if (app()->getLocale() == 'ar')
                        <img src="{{ asset('assets/front') }}/photo/logo2.png" class="image-logo">
                    @else
                        <img src="{{ asset('assets/front') }}/photo/logo.png" class="image-logo">
                    @endif
                </a>
            </div>
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
