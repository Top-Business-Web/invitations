<div id="test-invitation" class="pt-5 pb-5 bg-white">
    <div class="container">
      <div class="text-center">
        <h2 class="color2">{{ __('site.try_invite_invitations_now') }}</h2>
        <p>{{ __('site.the_invitation_will') }}</p>
        <img src="{{ asset('assets/front') }}/photo/section-title.png" style="height: 40px;">
      </div>
      <form class="row g-3 mt-3" id="guestForm" action="{{ route('guestTemplate') }}" method="get">
        <div class="col-md-6 col-12 mb-3">
          <label for="validationDefault03" class="form-label">{{ __('site.the_name') }} : </label>
          <input type="text" name="name" class="form-control" id="validationDefault03" required>
        </div>
        <div class="col-md-6 col-12 mb-3">
            <label for="validationDefault03" class="form-label">{{ __('site.surname') }} : </label>
            <input type="text" name="surname" class="form-control" id="validationDefault03" required>
          </div>
          <div class="col-md-6 col-12 mb-3">
            <label for="validationDefault03" class="form-label">{{ __('site.area_code') }} : </label>
            <input type="text" name="area_code" class="form-control" id="validationDefault03" required>
          </div>
          <div class="col-md-6 col-12 mb-3">
            <label for="validationDefault03" class="form-label">{{ __('site.phone') }} : </label>
            <input type="text" name="phone" class="form-control" id="validationDefault03" required>
          </div>
        <div class="col-12 d-flex justify-content-center mt-4">
          <button class="main-btn" type="submit">{{ __('site.request_a_trial_invitation') }}</button>
      </div>
      </form>
    </div>
  </div>
