@if(Route::currentRouteName() == 'index')
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
                    <a class="nav-link active" aria-current="page" href="#about">دعوات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#test-invitation">جرب دعوة دعوات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#advantage">المميزات</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#client">العملاء</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="#contact">تواصل معنا</a>
                </li>
            </ul>
                <a href="{{ route('signIn') }}" class="text-decoration-none btn-login">تسجيل دخول</a>
            <div class="dropdown" style="z-index: 100000;">
                <button class="btn-language dropdown-toggle text-black" type="button" id="dropdownMenuButton1"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="{{ asset('assets/front') }}/photo/english.png">
                    english
                </button>
                <ul class="dropdown-menu text-end" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item btn-language btn-color" href="#">
                            <img src="{{ asset('assets/front') }}/photo/arabic.png" class="ms-2">
                            arabic
                        </a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
@else
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
      <a class="navbar-brand" href="{{ route('index') }}">
        <img class="image-logo" src="{{ asset($setting->logo) }}" alt="no logo">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse bg-white" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('invites') }}">دعواتى</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="{{ route('contact.index') }}">جهات الاتصال</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                   حسابى
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <li><a class="dropdown-item" href="{{ route('profile') }}">ملفى الشخصى</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="{{ route('user.logout') }}">تسجيل خروج</a></li>
                </ul>
              </li>
        </ul>
        <div class="dropdown" style="z-index: 100000;">
          <button class="btn-language dropdown-toggle text-black" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
            <img src="{{ asset('assets/front') }}/photo/english.png">
            english
          </button>
          <ul class="dropdown-menu text-end" aria-labelledby="dropdownMenuButton1">
            <li><a class="dropdown-item btn-language btn-color" href="#">
              <img src="{{ asset('assets/front') }}/photo/arabic.png" class="ms-2">
              arabic
            </a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  @endif
