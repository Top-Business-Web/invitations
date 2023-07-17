<div class="section pt-5 pb-5">
    <div class="container">
      <div class="d-flex justify-content-between">
        <h3>دعواتى</h3>
        <a href="{{ route('addInvites') }}" class="text-decoration-none main-btn1">انشاء دعوة</a>
      </div>
      <div class="row mt-5">
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <select class="form-select" aria-label="Default select example">
            <option selected>ترتيب حسب</option>
            <option value="1">الاسم</option>
            <option value="2">التاريخ</option>
            <option value="3">الحالة</option>
          </select>
        </div>
        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
          <input class="form-control" type="search" placeholder="بحث">
        </div>
      </div>
  
      @foreach ($invites as $invite)
      <div class="card-invite mt-2">
        <button class="btn-faq d-flex justify-content-between align-items-center w-100" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
          <div class="row" style="width: 50%;">
            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center">
              <h5>{{ $invite->title }}</h5>
            </div>
            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center">
              <p class="btn-active">{{ $invite->status == "0" ? 'مو' }}</p>
            </div>
            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center">
              <p>{{ $invite->date }}</p>
            </div>
          </div>
          <div class="faq-icon" id="icon1">
            <i class="fa-solid fa-angle-down"></i>
          </div>
        </button>
        <div class="collapse" id="collapseExample">
          <div class="row mt-4">
            <div class="col-lg-3 col-12 mb-2">
              <img src="{{ asset('assets/front') }}/photo/blog2.jpg" alt="no-image" class="image-details">
            </div>
            <div class="col-lg-7 col-12">
              <div class="d-flex mb-2">
                <div class="color2 ms-2"><i class="fa-solid fa-location-dot"></i></div>
                <div></div>
              </div>
              <div class="d-flex mb-2">
                <div class="color2 ms-2"><i class="fa-solid fa-calendar-days"></i></div>
                <div>5/7/2023</div>
              </div>
              <div class="d-flex mb-2">
                <div class="color2 ms-2"><i class="fa-solid fa-lock"></i></div>
                <div>كلمة المرور للتطبيق</div>
              </div>
              <p>123456</p>
              <div style="margin-top: 35px;">
                <a href="#" class="text-decoration-none btn-login">حمل التطبيق</a>
              </div>
            </div>
            <div class="col-lg-1 col-6 d-flex justify-content-end">
              <div class="edit">
                <a href="add-invite.html"><i class="fa-solid fa-pen-to-square"></i></a>
              </div>
            </div>
            <div class="col-lg-1 col-6">
              <div class="edit delete">
                <a href="#"><i class="fa-solid fa-trash-can"></i></a>
              </div>
            </div>
          </div>
          <div class="mt-5">
            <h6 class="mb-2">حالات جهات الاتصال</h6>
            <div class="row">
              <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="details-number text-center btn-hand" data-content=".single-table">
                  <p class="mb-0">1</p>
                  <p class="mb-0">الممسوحة ضوئيا</p>
                </div>
              </div>
              <!-- More columns here -->
            </div>
          </div>
          <!-- More sections here -->
        </div>
      </div>
      @endforeach
  
    </div>
  </div>
  