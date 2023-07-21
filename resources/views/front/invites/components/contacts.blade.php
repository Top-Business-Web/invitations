<div class="section pt-5 pb-5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3>دعواتى</h3>
<<<<<<< HEAD
            <a href="{{route('addInvites')}}" class="text-decoration-none main-btn1">انشاء دعوة</a>
=======
            <a href="{{ route('addInvites') }}" class="text-decoration-none main-btn1">انشاء دعوة</a>
>>>>>>> c632385be796cf2a55361ae0b3af62adca452878
        </div>
        <div class="row mt-5" <?php echo $invitations->isEmpty() ? 'hidden' : ''; ?>>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <select class="form-select" aria-label="Default select example">
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
<<<<<<< HEAD
        @foreach ($invitations as $invitation)
            <div class="card-invite mt-2">
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
=======
        @if ($invitations->isEmpty())
            @include('front.not_found.not_found')
        @else
            @foreach ($invitations as $invitation)
                <div class="card-invite mt-2" id="invitationTable">
                    <button class="btn-faq d-flex justify-content-between align-items-center w-100"
                        data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $invitation->id }}"
                        aria-expanded="false" aria-controls="collapseExample">
                        <div class="row" style="width: 50%;">
                            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center">
                                <h5>{{ $invitation->title }}</h5>
>>>>>>> c632385be796cf2a55361ae0b3af62adca452878
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
                                <div class="edit">
                                    <button type="button" data-id="$admins->id"
                                        class="btn btn-primary editBtn fa-solid fa-pen-to-square"></button>
                                </div>
                            </div>
                            <div class="col-lg-1 col-6">
                                <div class="edit">
                                    <button type="button" class="btn btn-primary fa-solid fa-trash-can"
                                        data-toggle="modal" data-target="#exampleModal"
                                        data-invitation_id="{{ $invitation->id }}"
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
                                    <div class="details-number text-center">
                                        <p class="mb-0">{{ @$invitation->confirmed->count() }}</p>
                                        <p class="mb-0"> تأكيد</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center">
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
                                    <div class="details-number text-center">
                                        <p class="mb-0">{{ @$invitation->waiting->count() }}</p>
                                        <p class="mb-0"> لايوجد رد</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center">
                                        <p class="mb-0">{{ @$invitation->apologized->count() }}</p>
                                        <p class="mb-0"> فشل</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center">
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
                                    <div class="details-number bg-color1 text-center">
                                        <p class="mb-0">{{ @$invitation->not_sent_whatsapp->count() }}</p>
                                        <p class="mb-0">لم ترسل</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center">
                                        <p class="mb-0">{{ @$invitation->received_whatsapp->count() }}</p>
                                        <p class="mb-0"> تم الاستلام</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center">
                                        <p class="mb-0">{{ @$invitation->readIt_whatsapp->count() }}</p>
                                        <p class="mb-0"> قرأ</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center">
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
                                    <div class="details-number bg-color2 text-center">
                                        <p class="mb-0">{{ $invitation->not_received_qr->count() }}</p>
                                        <p class="mb-0">لايوجد حالة التسليم</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center">
                                        <p class="mb-0">{{ $invitation->received_qr->count() }}</p>
                                        <p class="mb-0"> تم الاستلام</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center">
                                        <p class="mb-0">{{ $invitation->read_it_qr->count() }}</p>
                                        <p class="mb-0"> قرأ</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center">
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
                                    <div class="scroll hand-invite">
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
                                                <table>
                                                    <thead>
                                                        <!-- Table header content... -->
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
                                                            <td>{{ $statuses[$userScanned->invitee->status] }}</td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
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

    // function to get invitation id and title 
    $(document).ready(function() {
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var invitationId = button.data('invitation_id');
            var invitationTitle = button.data('invitation-title');

            $('#invitationId').text(invitationId);
            $('#invitationTitle').text(invitationTitle);
        });

        $('#deleteButton').on('click', function() {
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
                        setTimeout(() => {
                            toastr.success('تم الحذف');
                            location.reload();
                        }, 2000);
                    } else {
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
