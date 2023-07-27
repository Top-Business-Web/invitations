<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('front.layouts.head')

<body>
    @include('front.layouts.nav')


    <div class="section pt-5 pb-5">
        <div class="container">
            <div class="progress-line mb-5">
                <div class="step">
                    <p>{{ __('site.call_information') }}</p>
                    <div class="bullet">
                        <span>1</span>
                    </div>
                    <div class="check"><i class="fa-solid fa-check"></i></div>
                </div>
                <div class="step">
                    <p>{{ __('site.send_invitation') }}</p>
                    <div class="bullet">
                        <span>2</span>
                    </div>
                    <div class="check"><i class="fa-solid fa-check"></i></div>
                </div>
            </div>
            <div class="form-outer">
                <div class="form">
                    <!-- start first step -->
                    <div class="page slidePage">
                        <div class="">
                            <input name="image" id="image" type="file" class="dropify" data-default-file="">
                        </div>
                        <div class="row g-3">

                            <div class="col-md-4 col-12">
                                <label class="form-label">{{ __('site.the_date_of_the_occasion') }}</label>
                                <input type="text" name="date" class="form-control input-field" id="datepicker">
                            </div>
                            <div class="col-md-4 col-12">
                                <label class="form-label">{{ __('site.the_name') . ' ' . __('site.occasion') }} </label>
                                <input type="text" name="title" class="form-control input-field" id="title">
                            </div>

                            <div class="col-md-4 col-12">
                                <label class="form-label">{{ __('site.choose_a_surname') }}</label>
                                <select name="sur_name" id="sur_name" class="form-control">
                                    <option value="mr/mis">mr/mis</option>
                                    <option value="honored">honored</option>
                                </select>
                            </div>

                            <div class="col-md-12 col-12">
                                <label class="form-label">{{ __('site.appropriate_site') }}</label>
                                <input name="address" id="searchMapInput" type="text"
                                    class="form-control mapControls input-field">
                                <div id="map"></div>

                                <div style="display: none" id="geoData">
                                    <input style="border: 1px solid #ccc" name="address" type="text"
                                        id="location-snap">
                                    <input style="border: 1px solid #ccc" name="longitude" type="text"
                                        id="lng-span">
                                    <input style="border: 1px solid #ccc" name="latitude" type="text" id="lat-span">
                                </div>

                            </div>


                            <div class="col-12 mb-2">
                                <input type="hidden" name="has_qrcode" value="0">
                                <input class="form-check-input" name="has_qrcode" value="1" type="checkbox"
                                    id="flexRadioDefault1">
                                <label class="form-check-label fw-bold" for="flexRadioDefault1">
                                    {{ __('site.show_the_access_code') }}
                                </label>
                            </div>
                            <div class="col-lg-4 col-12 mb-3 mt-4">
                                <a href="{{ route('invites') }}" class="text-decoration-none btn-login">{{ __('site.back') }}</a>
                            </div>
                            <div class="col-lg-8 col-12 d-flex mt-4 justify-content-end">
                                <a href="#" class="text-decoration-none btn-login" id="addDraftInvite"
                                    style="background-color: #C7C7C7;">{{ __('site.save_to_drafts') }}</a>
                                <button type="button" id="step1Btn" class="next-btn main-btn1 step1Btn">{{ __('site.save_and_continue') }}
                                    </button>
                            </div>
                        </div>
                    </div>
                    <!-- end first step -->

                    <!-- start second step -->
                    <div class="page">
                        {{--                    <h5 class="mb-3">تحديث الضيوف الاضافين</h5> --}}
                        {{--                    <div class="incr-decr-number mb-4"> --}}
                        {{--                        <input type="button" value="+" class="inc"> --}}
                        {{--                        <input type="text" value="0" class="input-field"> --}}
                        {{--                        <input type="button" value="-" class="dec"> --}}
                        {{--                    </div> --}}
                        <div class="d-flex justify-content-center mb-5">
                            <a href="{{ route('contacts.showExcel') }}" style="text-decoration: none"
                                class="main-btn1 bg-color">
                                استيراد ضيوف
                            </a>
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
                                    @foreach ($contacts as $index => $contact)
                                        <input type="hidden" class="invitees_name" name="invitees_name"
                                            value="{{ $contact->name }}">
                                        <input type="hidden" class="invitees_email" name="invitees_email"
                                            value="{{ $contact->email }}">
                                        <input type="hidden" class="invitees_phone" name="invitees_phone"
                                            value="{{ $contact->phone }}">
                                        <tr>
                                            <td scope="row">{{ $index + 1 }}</td>
                                            <td>{{ $contact->name }}</td>
                                            <td>{{ $contact->email ?? '-' }}</td>
                                            <td>
                                                <div class="incr-decr-number">
                                                    <input type="button" value="+" class="inc">
                                                    <input type="text" value="0" name="invitees_number"
                                                        class="input-field invitees_number">
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
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <h5 class="mt-4 mb-4">معاينة</h5>
                        <div class="row">
                            <div class="col-lg-4 col-12">
                                <div class="image-card mb-3">
                                    <img class="imagePreview" alt="no-image">
                                </div>
                                <h5 id="user_name">{{ auth()->user()->name }}</h5>
                                <p>يتشرف بدعوتكم لحضور <span id="invition_title"></span></p>
                                <div class="d-flex mb-2">
                                    <button class="main-btn1" style="background-color: #C7C7C7;"> تأكيد</button>
                                    <button class="main-btn1" style="background-color: #C7C7C7;"> اعتذار</button>
                                </div>
                                <button class="main-btn1" style="width:300px;background-color: #C7C7C7;">موقع
                                    المناسبة
                                </button>
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
                            <button class="next1-btn main-btn1" id="step2Btn">حفظ ومتابعة</button>
                        </div>
                    </div>
                    <!-- end second step -->
                </div>
            </div>
        </div>
    </div>


    <!-- Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="mb-3">استيراد جهات الاتصال من ملف اكسيل</h5>
                    <p>1- احفظ الملف على صيغة اكسيل</p>
                    <p>2- نسق بيانات الاتصال على هذا الشكل</p>
                    <div class="scroll">
                        <table class="table table-striped border">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">البريد الالكترونى</th>
                                    <th scope="col">الهاتف</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">1</td>
                                    <td>AYA</td>
                                    <td>-</td>
                                    <td>01050489206</td>
                                </tr>
                                <tr>
                                    <td scope="row">2</td>
                                    <td>AYA</td>
                                    <td>aya@gmail.com</td>
                                    <td>01050489206</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mb-2 mt-4">
                        <button class="btn-login" type="submit" style="border: none;">رفع الملف</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="validationCustom04" class="form-label">اللغة</label>
                            <select class="form-select" id="validationCustom04" required>
                                <option selected disabled value="">حدد الغة</option>
                                <option>عربى</option>
                                <option>انجليزى</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label">اسم المناسبة</label>
                            <input type="text" class="form-control titlePreview" required>
                        </div>
                    </div>
                    <h5 class="mt-4 mb-4">معاينة</h5>
                    <div class="row">
                        <div class="col-12">
                            <div class="image-card mb-3">
                                <img src="" class="imagePreview" alt="no-image">
                            </div>
                            <h5>{{ auth()->user()->name }}</h5>
                            <p> يتشرف بدعوتكم لحضور <span class="titlePreview"></span></p>
                            <div class="d-flex mb-2">
                                <button class="main-btn1" style="background-color: #C7C7C7;"> تأكيد</button>
                                <button class="main-btn1" style="background-color: #C7C7C7;"> اعتذار</button>
                            </div>
                            <button class="main-btn1" style="width:300px;background-color: #C7C7C7;">موقع
                                المناسبة</button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center mb-2 mt-5">
                        <button class="btn-login" type="submit" style="border: none;"> حفظ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--    <!-- invite Info --> --}}
    {{--    @include('front.add_invite.components.invite_info') --}}

    {{--    <!-- invite Excel--> --}}
    {{--    @include('front.add_invite.components.invite_excel') --}}

    {{--    @include('front.add_invite.components.invite_edit') --}}

    @include('front.layouts.scripts')

    <script>
        $('.dropify').dropify();
    </script>

</body>

</html>
