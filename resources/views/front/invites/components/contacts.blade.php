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
        <div class="card-invite mt-2">
            <button class="btn-faq d-flex justify-content-between align-items-center w-100" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <div class="row" style="width: 50%;">
                    <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center">
                        <h5>عيد ميلاد</h5>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center">
                        <p class="btn-active">مؤكد</p>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center">
                        <p>5/7/2023</p>
                    </div>
                </div>
                <div class="faq-icon" id="icon1">
                  <i class="fa-solid fa-angle-down"></i>
                </div>
            </button>
            <div class="collapse" id="collapseExample">
                <div class="row mt-4">
                    <div class="col-lg-3 col-12 mb-2">
                        <img src="photo/blog2.jpg" alt="no-image" class="image-details">
                    </div>
                    <div class="col-lg-7 col-12">
                        <div class="d-flex mb-2">
                            <div class="color2 ms-2"><i class="fa-solid fa-location-dot"></i></div>
                            <div>PM5G+HMM, Al Olaya, Riyadh 12214, Saudi Arabia</div>
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
                            <div class="details-number text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0">الممسوحة ضوئيا</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> تأكيد</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> اعتذار</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> زار الصفحة</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> لايوجد رد</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0">  فشل</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> لم يدعوا بعد</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h6 class="mb-2">حالات دعوات الواتساب</h6>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color1 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0">لم ترسل</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color1 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> لا يوجد حالة التسليم</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color1 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> تم التوصيل</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color1 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> تم الاستلام</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color1 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0">  قرأ</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color1 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0">  فشل</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h6 class="mb-2">حالات تسليم رمز QR</h6>
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color2 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0">لايوجد حالة التسليم</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color2 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> تم التوصيل</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color2 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> تم الاستلام</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color2 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0">  قرأ</p>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                            <div class="details-number bg-color2 text-center">
                                <p class="mb-0">1</p>
                                <p class="mb-0"> فشل </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <button type="button" class="btn-link btn-link-bg" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="fa-brands fa-whatsapp fa-lg ms-2"></i>
                            ارسال الدعوات عبر الواتساب
                          </button>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <button type="button" class="btn-link" data-bs-toggle="modal" data-bs-target="#exampleModalQr">
                            <i class="fa-solid fa-rotate-right fa-lg ms-2"></i>
                            ارسال رموز QR التى لم يتم تسليمها  
                          </button>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <a class="text-decoration-none" href="scan.html">
                            <button type="button" class="btn-link">
                                <i class="fa-solid fa-qrcode fa-lg ms-2"></i>
                               ادارة المسح الضوئى 
                              </button>
                        </a>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <button type="button" class="btn-link btn-hand" data-content=".hand-invite">
                            <i class="fa-solid fa-envelope fa-lg ms-2"></i>
                           ارسال الدعوات يدويا 
                          </button>
                    </div>
                    <div class="col-lg-4 col-md-6 col-12 mb-3">
                        <a class="text-decoration-none" href="reminder.html">
                            <button type="button" class="btn-link">
                                <i class="fa-solid fa-bell fa-lg ms-2"></i>
                               ارسال تذكير  
                              </button>
                        </a>
                    </div>

                    <div class="col-12 mt-5 hand-invite">
                        <div class="scroll">
                            <table class="table table-striped border">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">البريد الالكترونى</th>
                                    <th scope="col">الحالة</th>
                                    <th scope="col">الارسال يدوى</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td scope="row">1</td>
                                    <td>AYA</td>
                                    <td>-</td>
                                    <td>فشل</td>
                                    <td>
                                        <a href="https://wa.me/920033007" target="_blank" class="whatsapp">
                                            <i class="fa-brands fa-whatsapp fs-3"></i>
                                          </a>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
  </div>