@toastr_css
<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content d-flex align-items-center pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12"></div>
            <div class="col-lg-6 col-12">
                <h5 class="fw-bold text-center mb-4">{{ __('site.welcome_back') }}</h5>
                <form class="signup-form row" action="{{ route('user.login') }}" method="post" id="LoginFormUser">
                  @csrf
                    <div class="col-12">
                        <input type="email" name="email" class="w-100 mb-4 p-4" id="validationDefault03"
                            placeholder="{{ __('site.e_mail') }}" required>
                    </div>
                    <div class="col-12">
                        <input type="password" name="password" class="w-100 mb-4 p-4" id="validationDefault03" placeholder="{{ __('site.password') }}"
                            required>
                    </div>
                    <div class="col-12 d-flex justify-content-center">
                        <a href="{{ route('forgetPassword') }}" class="t-forget text-decoration-none">{{ __('site.forgot_your_password') }}
                            </a>
                    </div>
                    <div class="d-flex justify-content-center mb-2 mt-4">
                      <a href="#" class="text-decoration-none">
                          <button class="btn-submit" id="loginButtonUser">{{ __('site.sign_in') }}</button>
                      </a>
                  </div>
                </form>
                
                <div class="d-flex justify-content-center">
                    <p class="me-2 fs-6">{{ __('site.Dont_have_an_account_with_us?') }}</p>
                    <a href="{{ route('signUp') }}" class="t-singin text-decoration-none">{{ __('site.create_an_account') }} !</a>
                </div>
                <span class="test"></span>
                <span class="text-black-50 d-inline-block ms-2 me-2">او</span>
                <span class="test"></span>
                <div class="mt-3 text-center">
                    <a href="{{ route('login.google-redirect') }}" class="text-decoration-none icon-google">
                        <img src="{{ asset('assets/front') }}/photo/google.svg">
                        {{ __('site.sign_in_with_google') }}
                    </a>
                </div>
            </div>
            <div class="col-lg-3 col-12"></div>
        </div>
    </div>
</div>
@include('front.sign.sign_in.js')
