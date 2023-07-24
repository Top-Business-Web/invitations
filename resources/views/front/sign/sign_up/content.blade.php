@toastr_css
<div class="content d-flex align-items-center pt-5 pb-5">
  <div class="container">
      <div class="row">
          <div class="col-lg-3 col-12"></div>
          <div class="col-lg-6 col-12">
              <h5 class="fw-bold text-center mb-4">انشاء حساب !</h5>
              <form class="signup-form row" action="{{ route('user.register') }}" method="post" id="RegisterFormUser">
                @csrf
                <div class="col-12">
                  <input type="text" name="name" class="w-100 mb-4 p-4" id="validationDefault03" placeholder=" الاسم">
                </div>
                  <div class="col-12">
                      <input type="email" name="email" class="w-100 mb-4 p-4" id="validationDefault03" placeholder="البريد الالكترونى">
                    </div>
                    <div class="col-12">
                      <input type="text" name="phone" class="w-100 mb-4 p-4" id="validationDefault03" placeholder="رقم التليفون" >
                    </div>
                    <div class="col-12">
                      <input type="password" name="password" class="w-100 mb-4 p-4" id="validationDefault03" placeholder="كلمة المرور">
                    </div>
                    <div class="col-12 d-flex justify-content-center mb-2 mt-4">
                      <button class="btn-submit" id="RegisterUser"> انشاء حساب</button>
                    </div>
              </form>
              <div class="d-flex justify-content-center">
                  <p class="me-2 fs-6"> لديك حساب بالفعل ؟</p>
                  <a href="{{ route('signIn') }}" class="t-singin text-decoration-none">سجل الدخول</a>
              </div>
              <span class="test"></span>
              <span class="text-black-50 d-inline-block ms-2 me-2">او</span>
              <span class="test"></span>
              <div class="mt-3 text-center">
                  <a href="{{ route('login.google-redirect') }}" class="text-decoration-none icon-google">
                      <img src="{{ asset('assets/front') }}/photo/google.svg">
                      سجل الدخول باستخدام جوجل
                  </a>
              </div>
          </div>
          <div class="col-lg-3 col-12"></div>
      </div>
  </div>
</div>
@include('front.sign.sign_up.js')