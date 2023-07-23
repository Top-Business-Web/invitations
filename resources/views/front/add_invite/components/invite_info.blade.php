<div class="section pt-5 pb-5">
    <div class="container">
        <div class="progress-line mb-5">
            <div class="step">
                <p>معلومات الدعوة</p>
                <div class="bullet">
                    <span>1</span>
                </div>
                <div class="check"><i class="fa-solid fa-check"></i></div>
            </div>
            <div class="step">
                <p>ارسال الدعوة</p>
                <div class="bullet">
                    <span>2</span>
                </div>
                <div class="check"><i class="fa-solid fa-check"></i></div>
            </div>
        </div>

    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('addInvitationByClient')}}" >

        <div class="form-outer">
            <div class="form">

                <div class="page slidePage">
                    <div class="">
                        <input name="image" id="image" type="file" class="dropify" data-default-file="">
                    </div>
                    <div class="row g-3">

                        <div class="col-md-4 col-12">
                            <label class="form-label">تاريخ المناسبة</label>
                            <input type="text" class="form-control" id="datepicker">
                        </div>
                        <div class="col-md-4 col-12">
                            <label class="form-label">اسم المناسبة</label>
                            <input type="text" class="form-control" id="title">
                        </div>

                        <div class="col-md-4 col-12">
                            <label class="form-label">اختر اللقب</label>
                            <select name="sur_name" id="sur_name" class="form-control">
                                <option value="mr/mis">mr/mis</option>
                                <option value="honored">honored</option>
                            </select>
                        </div>

                        <div class="col-md-12 col-12">
                            <label class="form-label">موقع المناسبة</label>
                            <input name="searchMapInput" id="searchMapInput"  type="text" class="form-control mapControls">
                            <div id="map"></div>

                            <div style="display: none"  id="geoData">
                                <input style="border: 1px solid #ccc"  type="text"  id="location-snap">
                                <input style="border: 1px solid #ccc"  type="text"  id="lng-span">
                                <input style="border: 1px solid #ccc"  type="text"  id="lat-span">
                            </div>

                        </div>



                        <div class="col-12 mb-2">
                            <input class="form-check-input" type="checkbox" name="flexRadioDefault"
                                id="flexRadioDefault1">
                            <label class="form-check-label fw-bold" for="flexRadioDefault1">
                                اظهار كود الدخول
                            </label>
                        </div>
                        <div class="col-lg-4 col-12 mb-3 mt-4">
                            <a href="invite.html" class="text-decoration-none btn-login"> عودة</a>
                        </div>
                        <div class="col-lg-8 col-12 d-flex mt-4 justify-content-end">
                            <a href="invite.html" class="text-decoration-none btn-login"
                                style="background-color: #C7C7C7;"> حفظ فى المسودات</a>

{{--                            <button type="submit"  id="addButton" class="next-btn main-btn1">حفظ ومتابعة</button>--}}
                            <button type="submit"  id="addButton" class="main-btn1">حفظ ومتابعة</button>
                        </div>
                    </div>
                </div>
                {{-- end first step--}}


                <div class="page">
                    <h5 class="mb-3">تحديث الضيوف الاضافين</h5>
                    <div class="incr-decr-number mb-4">
                        <input type="button" value="+" class="inc">
                        <input type="text" value="0" class="input-field">
                        <input type="button" value="-" class="dec">
                    </div>
                    <div class="d-flex justify-content-center mb-5">
                        <button type="button" class="main-btn1 bg-color" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            ضيوف الاستيراد
                        </button>
                        <a href="{{ route('contact.index') }}" class="text-decoration-none">
                            <button type="button" class="main-btn1 guest-btn">اضافة ضيف</button>
                        </a>
                    </div>
                    <div class="scroll">
                        <table class="table border">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">البريد الالكترونى</th>
                                    <th scope="col">المرافقين</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>AYA</td>
                                    <td>-</td>
                                    <td>
                                        <div class="incr-decr-number">
                                            <input type="button" value="+" class="inc">
                                            <input type="text" value="0" class="input-field">
                                            <input type="button" value="-" class="dec">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <button type="button" class="edit-table delete-table">
                                                <i class="fa-solid fa-trash-can fa-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td scope="row">2</td>
                                    <td>AYA</td>
                                    <td>-</td>
                                    <td>
                                        <div class="incr-decr-number">
                                            <input type="button" value="+" class="inc">
                                            <input type="text" value="0" class="input-field">
                                            <input type="button" value="-" class="dec">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="text-center">
                                            <button type="button" class="edit-table delete-table">
                                                <i class="fa-solid fa-trash-can fa-lg"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <h5 class="mt-4 mb-4">معاينة</h5>
                    <div class="row">
                        <div class="col-lg-4 col-12">
                            <div class="image-card mb-3">
                                <img src="{{ asset('assets/front') }}/photo/blog2.jpg" alt="no-image">
                            </div>
                            <h5>المكرم محمد</h5>
                            <p>يتشرف بدعوتكم لحضور عيد ميلا</p>
                            <div class="d-flex mb-2">
                                <button class="main-btn1" style="background-color: #C7C7C7;"> تأكيد</button>
                                <button class="main-btn1" style="background-color: #C7C7C7;"> اعتذار</button>
                            </div>
                            <button class="main-btn1" style="width:300px;background-color: #C7C7C7;">موقع
                                المناسبة</button>
                        </div>
                        <div class="col-lg-8 col-12"></div>
                        <div class="col-12 d-flex justify-content-end">
                            <button class="main-btn1 mt-4 mb-4" style="background-color: #C7C7C7;"
                                data-bs-toggle="modal" data-bs-target="#exampleModal1">
                                تحرير القالب
                            </button>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4 mb-5">
                        <button class="prev1-btn btn-login" style="border: none;">عودة</button>
                        <button class="next1-btn main-btn1">حفظ ومتابعة</button>
                    </div>
                </div>
            </div>
        </div>
    </form>


    </div>
</div>
