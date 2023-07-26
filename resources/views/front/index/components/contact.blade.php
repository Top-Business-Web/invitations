<div class="contact banner pt-5 pb-5" id="contact">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="color2">{{ __('site.connect_with_us') }}</h2>
      <p>{{ __('site.for_inquiries_and_more') }}</p>
      <img src="{{ asset('assets/front') }}/photo/section-title.png" style="height: 40px;">
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6 col-12">
          <div class="card-contact p-4">
              <div class="icon-contact"><i class="fa-solid fa-location-dot"></i></div>
              <h4 class="mt-3 mb-3">{{ __('site.the_address') }}</h4>
              <p class="color2">{{ $setting->address }}</p>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
          <div class="card-contact p-4">
              <div class="icon-contact"><i class="fa-regular fa-envelope-open"></i></div>
              <h4 class="mt-3 mb-3">{{ __('site.email') }}</h4>
              <a href="mailto: {{ $setting->email }}" class="text-decoration-none color2">{{ $setting->email }}</a>
          </div>
      </div>
      <div class="col-lg-4 col-md-6 col-12">
          <div class="card-contact p-4">
              <div class="icon-contact"><i class="fa-solid fa-phone"></i></div>
              <h4 class="mt-3 mb-3">{{ __('site.contact_number') }}</h4>
              <a href="https://wa.me/{{ $setting->phone }}" class="text-decoration-none color2" target="_blank">{{ $setting->phone }}</a>
          </div>
      </div>
  </div>
  </div>
</div>