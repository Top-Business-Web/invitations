<div class="content d-flex align-items-center pt-5 pb-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-12"></div>

            <div class="col-lg-6 col-12">
                <h5 class="fw-bold text-center mb-4">{{ __('site.enter_a_new_password') }}</h5>
                <form action="{{ route('password.reset.submit') }}" method="post">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="phone" value="{{$phone}}">
                        <input type="hidden" name="code" value="{{$code}}">
                        <div class="col-12">
                            <input type="password" name="password" class="w-100 mb-4 p-4" id="validationDefault03"
                                   placeholder="{{ __('site.password') }}" required>
                        </div>
                        <div class="col-12">
                            <input type="password" name="password" class="w-100 mb-4 p-4" id="validationDefault03"
                                   placeholder="{{ __('site.confirm_password') }}" required>
                        </div>
                        <div class="col-12 d-flex justify-content-center mb-2 mt-4">
                            <button class="btn-submit" type="submit">{{ __('site.confirm') }}</button>
                        </div>
                </form>
            </div>
        </div>
        <div class="col-lg-3 col-12"></div>
    </div>
</div>
</div>
