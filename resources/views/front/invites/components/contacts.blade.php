<div class="section pt-5 pb-5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3>دعواتى</h3>

            <a href="{{route('addInvites')}}" class="text-decoration-none main-btn1">انشاء دعوة</a>

        </div>
        <div class="row mt-5" <?php echo $invitations->isEmpty() ? 'hidden' : ''; ?>>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <select class="form-select" aria-label="Default select example" id="sortSelect">
                    <option selected>ترتيب حسب</option>
                    <option value="1">الاسم</option>
                    <option value="2">التاريخ</option>
                    <option value="3">الحالة</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <input class="form-control" type="search" placeholder="بحث" id="searchInput">
            </div>
        </div>
        @if ($invitations->isEmpty())
            @include('front.not_found.not_found')
        @else
            @foreach ($invitations as $invitation)
                <div class="card-invite mt-2" id="dataContainer">
                    <button class="btn-faq d-flex justify-content-between align-items-center w-100"
                            data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $invitation->id }}"
                            aria-expanded="false" aria-controls="collapseExample">
                        <div class="row" style="width: 50%;">
                            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center">
                                <h5>{{ $invitation->title }}</h5>

                            </div>
                            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center">
                                <p class="btn-active">{{ $invitation->status == '1' ? 'مؤكد' : 'غير مؤكد' }} </p>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center">
                                <p>{{ $invitation->date }}</p>
                            </div>
                        </div>
                        <div class="faq-icon" id="icon1">
                            <i class="fa-solid fa-angle-down"></i>
                        </div>
                    </button>
                    <div class="collapse" id="collapseExample{{ $invitation->id }}">
                        <div class="row mt-4">
                            <div class="col-lg-3 col-12 mb-2">
                                <img src="{{ asset($invitation->image) }}" alt="no-image" class="image-details">
                            </div>
                            <div class="col-lg-7 col-12">
                                <div class="d-flex mb-2">
                                    <div class="color2 ms-2"><i class="fa-solid fa-location-dot"></i></div>
                                    <div>{{ $invitation->address }}</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="color2 ms-2"><i class="fa-solid fa-calendar-days"></i></div>
                                    <div>{{ $invitation->date }}</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="color2 ms-2"><i class="fa-solid fa-lock"></i></div>
                                    <div>كلمة المرور للتطبيق</div>
                                </div>
                                <p>{{ $invitation->password }}</p>
                                <div style="margin-top: 35px;">
                                    <a href="#" class="text-decoration-none btn-login">حمل التطبيق</a>
                                </div>
                            </div>
                            <div class="col-lg-1 col-6 d-flex justify-content-end">
                                <button class="btn btn-primary fa-solid fa-pen-to-square"
                                        id="editBtnInvite" data-id="{{ $invitation->id }}">
                                </button>
                            </div>
                            <div class="col-lg-1 col-6">
                                <div class="delete">
                                    <button type="button" class="btn btn-primary fa-solid fa-trash-can"
                                            data-toggle="modal" data-target="#exampleModal"
                                            data-invitation-id="{{ $invitation->id }}"
                                            data-invitation-title="{{ $invitation->title }}"></button>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5">
                            <h6 class="mb-2">حالات جهات الاتصال</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand" data-content=".single-table">
                                        <p class="mb-0">{{ @$invitation->scanned->count() }}</p>
                                        <p class="mb-0">الممسوحة ضوئيا</p>
                                    </div>
                                </div>



                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand" data-content=".confirmed">
                                        <p class="mb-0">{{ @$invitation->confirmed->count() }}</p>
                                        <p class="mb-0"> تأكيد</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand" data-content=".apologized">
                                        <p class="mb-0">{{ @$invitation->apologized->count() }}</p>
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
                                    <div class="details-number text-center btn-hand" data-content=".waiting">
                                        <p class="mb-0">{{ @$invitation->waiting->count() }}</p>
                                        <p class="mb-0"> لايوجد رد</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand"  data-content=".failed">
                                        <p class="mb-0">{{ @$invitation->apologized->count() }}</p>
                                        <p class="mb-0"> فشل</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand" data-content=".not-send">
                                        <p class="mb-0">{{ @$invitation->failed->count() }}</p>
                                        <p class="mb-0"> لم يدعوا بعد</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6 class="mb-2">حالات دعوات الواتساب</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center btn-hand" data-content=".not-sent-whatsapp">
                                        <p class="mb-0">{{ @$invitation->not_sent_whatsapp->count() }}</p>
                                        <p class="mb-0">لم ترسل</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center btn-hand" data-content=".received-whatsapp">
                                        <p class="mb-0">{{ @$invitation->received_whatsapp->count() }}</p>
                                        <p class="mb-0"> تم الاستلام</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center btn-hand" data-content=".readIt-whatsapp">
                                        <p class="mb-0">{{ @$invitation->readIt_whatsapp->count() }}</p>
                                        <p class="mb-0"> قرأ</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center btn-hand" data-content=".faild-whatsapp">
                                        <p class="mb-0">{{ $invitation->faild_whatsapp->count() }}</p>
                                        <p class="mb-0"> فشل</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6 class="mb-2">حالات تسليم رمز QR</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center btn-hand" data-content=".not-received-qr">
                                        <p class="mb-0">{{ $invitation->not_received_qr->count() }}</p>
                                        <p class="mb-0">لايوجد حالة التسليم</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center btn-hand" data-content=".received-qr">
                                        <p class="mb-0">{{ $invitation->received_qr->count() }}</p>
                                        <p class="mb-0"> تم الاستلام</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center btn-hand" data-content=".read-it-qr">
                                        <p class="mb-0">{{ $invitation->read_it_qr->count() }}</p>
                                        <p class="mb-0"> قرأ</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center btn-hand" data-content=".faild-qr">
                                        <p class="mb-0">{{ $invitation->faild_qr->count() }}</p>
                                        <p class="mb-0"> فشل </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <button type="button" class="btn-link btn-link-bg" data-bs-toggle="modal"
                                        data-bs-id="{{ $invitation->id }}" data-bs-target="#modalWhatsApp">
                                    <i class="fa-brands fa-whatsapp fa-lg ms-2"></i> ارسال الدعوات عبر الواتساب
                                </button>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <button type="button" class="btn-link" data-bs-toggle="modal"
                                        data-bs-target="#exampleModalQr">
                                    <i class="fa-solid fa-rotate-right fa-lg ms-2"></i>
                                    ارسال رموز QR التى لم يتم تسليمها
                                </button>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <a class="text-decoration-none"
                                   href="{{ route('showUserScanned', $invitation->id) }}">
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
                                <a class="text-decoration-none" href="{{ route('reminder', $invitation->id) }}">
                                    <button type="button" class="btn-link">
                                        <i class="fa-solid fa-bell fa-lg ms-2"></i>
                                        ارسال تذكير
                                    </button>
                                </a>
                            </div>


                            <div class="col-12 mt-5">
                                <div class="content-list">

                                    <div class="scroll hand-invite failed">
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

                                                @if ($invitation->failed->isEmpty())
                                                    <tr>
                                                        <td colspan="5" class="text-center">لا يوجد معلومات
                                                        </td>
                                                    </tr>
                                                @else
                                                    @foreach ($invitation->failed as $userFailed)
                                                        <tr>
                                                            <td scope="row">{{ $userFailed->id }}</td>
                                                            <td>{{ $userFailed->name }}</td>
                                                            <td>{{ $userFailed->email }}</td>
                                                            <td>{{ $statuses[$userFailed->status] }}</td>
                                                            <td>
                                                                <a href="https://wa.me/920033007"
                                                                   target="_blank" class="whatsapp">
                                                                    <i class="fa-brands fa-whatsapp fs-3"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>



                                    <div class="scroll single-table">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->scanned->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->scanned as $userScanned)
                                                    <tr>
                                                        <td scope="row">{{ $userScanned->invitee->id }}</td>
                                                        <td>{{ $userScanned->invitee->name }}</td>
                                                        <td>{{ $userScanned->invitee->email }}</td>
                                                        <td>{{ $userScanned->invitee->phone }}</td>
                                                        <td>Scanned</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}



                                    <div class="scroll confirmed">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->confirmed->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->confirmed as $userConfirmed)
                                                    <tr>
                                                        <td scope="row">{{ $userConfirmed->id }}</td>
                                                        <td>{{ $userConfirmed->name }}</td>
                                                        <td>{{ $userConfirmed->email }}</td>
                                                        <td>{{ $userConfirmed->phone }}</td>
                                                        <td>{{ $statuses[$userConfirmed->status] }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}


                                          <div class="scroll apologized">

                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody id="bodyData">

                                            @if ($invitation->apologized->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->apologized as $userApologized)
                                                    <tr>
                                                        <td scope="row">{{ $userApologized->id }}</td>
                                                        <td>{{ $userApologized->name }}</td>
                                                        <td>{{ $userApologized->email }}</td>
                                                        <td>{{ $userApologized->phone }}</td>
                                                        <td>{{ $statuses[$userApologized->status] }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}




                                    <div class="scroll waiting">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->waiting->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->waiting as $userWaiting)
                                                    <tr>
                                                        <td scope="row">{{ $userWaiting->id }}</td>
                                                        <td>{{ $userWaiting->name }}</td>
                                                        <td>{{ $userWaiting->email }}</td>
                                                        <td>{{ $userWaiting->phone }}</td>
                                                        <td>{{ $statuses[$userWaiting->status] }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}


                                    <div class="scroll not-send">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->not_sent->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->not_sent as $userNotSent)
                                                    <tr>
                                                        <td scope="row">{{$userNotSent->id }}</td>
                                                        <td>{{ $userNotSent->name }}</td>
                                                        <td>{{ $userNotSent->email }}</td>
                                                        <td>{{ $userNotSent->phone }}</td>
                                                        <td>{{ $statuses[$userNotSent->status] }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}


                                    {{-- start read of whatsapp status--}}

                                    <div class="scroll not-sent-whatsapp">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->not_sent_whatsapp->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->not_sent_whatsapp as $not_sent_whatsapp)
                                                    <tr>
                                                        <td scope="row">{{$not_sent_whatsapp->invitee->id }}</td>
                                                        <td>{{ $not_sent_whatsapp->invitee->name }}</td>
                                                        <td>{{ $not_sent_whatsapp->invitee->email }}</td>
                                                        <td>{{ $not_sent_whatsapp->invitee->phone }}</td>
                                                        <td>Not Send</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}



                                    <div class="scroll received-whatsapp">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->received_whatsapp->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->received_whatsapp as $received_whatsapp)
                                                    <tr>
                                                        <td scope="row">{{$received_whatsapp->invitee->id }}</td>
                                                        <td>{{ $received_whatsapp->invitee->name }}</td>
                                                        <td>{{ $received_whatsapp->invitee->email }}</td>
                                                        <td>{{ $received_whatsapp->invitee->phone }}</td>
                                                        <td>Received</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}




                                    <div class="scroll readIt-whatsapp">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->readIt_whatsapp->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->readIt_whatsapp as $readIt_whatsapp)
                                                    <tr>
                                                        <td scope="row">{{$readIt_whatsapp->invitee->id }}</td>
                                                        <td>{{ $readIt_whatsapp->invitee->name }}</td>
                                                        <td>{{ $readIt_whatsapp->invitee->email }}</td>
                                                        <td>{{ $readIt_whatsapp->invitee->phone }}</td>
                                                        <td>Read</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}



                                    <div class="scroll faild-whatsapp">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->faild_whatsapp->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->faild_whatsapp as $faild_whatsapp)
                                                    <tr>
                                                        <td scope="row">{{$faild_whatsapp->invitee->id }}</td>
                                                        <td>{{ $faild_whatsapp->invitee->name }}</td>
                                                        <td>{{ $faild_whatsapp->invitee->email }}</td>
                                                        <td>{{ $faild_whatsapp->invitee->phone }}</td>
                                                        <td>Failed </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}


                                    {{-- start read of Qr status--}}
                                    <div class="scroll not-received-qr">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->not_received_qr->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->not_received_qr as $not_received_qr)
                                                    <tr>
                                                        <td scope="row">{{$not_received_qr->invitee->id }}</td>
                                                        <td>{{ $not_received_qr->invitee->name }}</td>
                                                        <td>{{ $not_received_qr->invitee->email }}</td>
                                                        <td>{{ $not_received_qr->invitee->phone }}</td>
                                                        <td>not received qr</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}



                                    <div class="scroll received-qr">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->received_qr->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->received_qr as $received_qr)
                                                    <tr>
                                                        <td scope="row">{{$received_qr->invitee->id }}</td>
                                                        <td>{{ $received_qr->invitee->name }}</td>
                                                        <td>{{ $received_qr->invitee->email }}</td>
                                                        <td>{{ $received_qr->invitee->phone }}</td>
                                                        <td> received qr </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}




                                    <div class="scroll read-it-qr">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->read_it_qr->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->read_it_qr as $read_it_qr)
                                                    <tr>
                                                        <td scope="row">{{$read_it_qr->invitee->id }}</td>
                                                        <td>{{ $read_it_qr->invitee->name }}</td>
                                                        <td>{{ $read_it_qr->invitee->email }}</td>
                                                        <td>{{ $read_it_qr->invitee->phone }}</td>
                                                        <td> read it qr </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}



                                    <div class="scroll faild-qr">
                                        <table class="table table-striped border">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">الاسم</th>
                                                <th scope="col">البريد الالكترونى</th>
                                                <th scope="col">الهاتف</th>
                                                <th scope="col"> الحالة</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @if ($invitation->faild_qr->isEmpty())
                                                <tr>
                                                    <td colspan="5" class="text-center">لا يوجد معلومات
                                                    </td>
                                                </tr>
                                            @else
                                                @foreach ($invitation->faild_qr as $faild_qr)
                                                    <tr>
                                                        <td scope="row">{{$faild_qr->invitee->id }}</td>
                                                        <td>{{ $faild_qr->invitee->name }}</td>
                                                        <td>{{ $faild_qr->invitee->email }}</td>
                                                        <td>{{ $faild_qr->invitee->phone }}</td>
                                                        <td> failed qr </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    {{--end div of table--}}





                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<!-- Modal Edit Invite  -->

<div class="modal fade bd-example-modal-lg" id="editInvite" tabindex="-1" role="dialog"
     aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modal-body">
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تأكيد الحذف</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                هل أنت متأكد أنك تريد حذف: <input type="hidden" id="invitationId">
                <span class=" text-danger" id="invitationTitle"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
                <button type="button" class="btn btn-danger" id="deleteButton">حذف</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->

@include('Admin/layouts/myAjaxHelper')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $('#editBtnInvite').on('click', function () {
        let id = $(this).data('id');
        let url = "{{ route('editInvitation',':id') }}";
        url = url.replace(':id', id);
        location.href = url;
    })

    // function to get invitation id and title
    $(document).ready(function () {
        $('#exampleModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var invitationId = button.data('invitation-id');
            var invitationTitle = button.data('invitation-title');

            $('#invitationId').text(invitationId);
            $('#invitationTitle').text(invitationTitle);
            console.log(invitationTitle);
        });

        $('#deleteButton').on('click', function () {
            var invitationId = $('#invitationId').text();
            fetch('/delete-invitation/' + invitationId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute('content'),
                    'Content-Type': 'application/json'
                }
            })
                .then(response => {
                    if (response.status === 200) {
                        toastr.success('تم الحذف');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        alert(invitationId)
                        alert('Failed to delete invitation. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again later.');
                });
        });
    });
</script>

