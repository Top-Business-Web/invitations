<div class="section pt-5 pb-5">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container">
        <div class="d-flex justify-content-between">
            <h3>{{ __('site.my_invitations') }}</h3>

            <a href="{{ route('addInvites') }}"
                class="text-decoration-none main-btn1">{{ __('site.create_an_invitation') }}</a>

        </div>
        <div class="row mt-5" <?php echo $invitations->isEmpty() ? 'hidden' : ''; ?>>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <select class="form-select" aria-label="Default select example" id="sortSelect">
                    <option selected>{{ __('site.sort_by') }}</option>
                    <option value="1">{{ __('site.the_name') }}</option>
                    <option value="2">{{ __('site.the_date') }}</option>
                    <option value="3">{{ __('site.the_status') }}</option>
                </select>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                <input class="form-control" type="search" placeholder="{{ __('site.search') }}"
                    onkeyup="searchInvitations(this.value)" data-user-id="{{ auth()->user()->id }}">
            </div>
            <div id="search-results"></div>
        </div>
        @if ($invitations->isEmpty())
            @include('front.not_found.not_found')
        @else
            @foreach ($invitations as $invitation)
                <div class="card-invite default mt-2" id="dataContainer">
                    <button class="btn-faq d-flex justify-content-between align-items-center w-100"
                        data-bs-toggle="collapse" data-bs-target="#collapseExample{{ $invitation->id }}"
                        aria-expanded="false" aria-controls="collapseExample">
                        <div class="row" style="width: 50%;">
                            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center">
                                <h5>{{ $invitation->title }}</h5>

                            </div>

                            <div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center">
                                <p style="{{ $invitation->status == 0 ? 'background-color : #E9EAEB;color: black;' : '' }}"
                                    class="btn-active">
                                    {{ $invitation->status == 1 ? __('site.confirmed') : __('site.un_confirmed') }}
                                </p>
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
                                    <div class="color2 me-2 ms-2"><i class="fa-solid fa-location-dot"></i></div>
                                    <div>{{ $invitation->address }}</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="color2 me-2 ms-2"><i class="fa-solid fa-calendar-days"></i></div>
                                    <div>{{ $invitation->date }}</div>
                                </div>
                                <div class="d-flex mb-2">
                                    <div class="color2 me-2 ms-2"><i class="fa-solid fa-lock"></i></div>
                                    <div>{{  app()->getlocale() == 'ar' ? 'كلمة المرور للتطبيق' : 'password for App' }}</div>
                                </div>
                                <p>{{ $invitation->password }}</p>
                                <div style="margin-top: 35px;">
                                    <a href="#"
                                        class="text-decoration-none btn-login">{{ __('SITE.download_the_app') }}</a>
                                </div>
                            </div>
                            <div class="col-lg-1 col-6 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary fa-solid fa-pen-to-square"
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
                            <h6 class="mb-2">{{ __('site.contact_statuses') }}</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand" data-content=".single-table">
                                        <p class="mb-0">{{ @$invitation->scanned->count() }}</p>
                                        <p class="mb-0">{{ __('site.scanned') }}</p>
                                    </div>
                                </div>



                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand" data-content=".confirmed">
                                        <p class="mb-0">{{ @$invitation->confirmed->count() }}</p>
                                        <p class="mb-0">{{ __('site.confirm') }}</p>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand" data-content=".apologized">
                                        <p class="mb-0">{{ @$invitation->apologized->count() }}</p>
                                        <p class="mb-0">{{ __('site.apology') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center">
                                        <p class="mb-0">1</p>
                                        <p class="mb-0">{{ __('site.visited_the_page') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand" data-content=".waiting">
                                        <p class="mb-0">{{ @$invitation->waiting->count() }}</p>
                                        <p class="mb-0">{{ __('site.no_answer') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand" data-content=".failed">
                                        <p class="mb-0">{{ @$invitation->apologized->count() }}</p>
                                        <p class="mb-0">{{ __('site.to_fail') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number text-center btn-hand" data-content=".not-send">
                                        <p class="mb-0">{{ @$invitation->failed->count() }}</p>
                                        <p class="mb-0">{{ __('site.they_havent_called_yet') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6 class="mb-2">{{ __('site.whatsApp_invitation_statuses') }}</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center btn-hand"
                                        data-content=".not-sent-whatsapp">
                                        <p class="mb-0">{{ @$invitation->not_sent_whatsapp->count() }}</p>
                                        <p class="mb-0">{{ __('site.did_not_send') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center btn-hand"
                                        data-content=".received-whatsapp">
                                        <p class="mb-0">{{ @$invitation->received_whatsapp->count() }}</p>
                                        <p class="mb-0">{{ __('site.it_was_received') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center btn-hand"
                                        data-content=".readIt-whatsapp">
                                        <p class="mb-0">{{ @$invitation->readIt_whatsapp->count() }}</p>
                                        <p class="mb-0">{{ __('site.read') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color1 text-center btn-hand"
                                        data-content=".faild-whatsapp">
                                        <p class="mb-0">{{ $invitation->faild_whatsapp->count() }}</p>
                                        <p class="mb-0">{{ __('site.to_fail') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h6 class="mb-2">{{ __('site.qr_code_delivery_statuses') }}</h6>
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center btn-hand"
                                        data-content=".not-received-qr">
                                        <p class="mb-0">{{ $invitation->not_received_qr->count() }}</p>
                                        <p class="mb-0">{{ __('site.there_is_no_delivery_status') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center btn-hand"
                                        data-content=".received-qr">
                                        <p class="mb-0">{{ $invitation->received_qr->count() }}</p>
                                        <p class="mb-0">{{ __('site.it_was_received') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center btn-hand"
                                        data-content=".read-it-qr">
                                        <p class="mb-0">{{ $invitation->read_it_qr->count() }}</p>
                                        <p class="mb-0">{{ __('site.read') }}</p>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                    <div class="details-number bg-color2 text-center btn-hand"
                                        data-content=".faild-qr">
                                        <p class="mb-0">{{ $invitation->faild_qr->count() }}</p>
                                        <p class="mb-0">{{ __('site.to_fail') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <button type="button" class="btn-link btn-link-bg" data-bs-toggle="modal"
                                    data-bs-id="{{ $invitation->id }}" data-bs-target="#modalWhatsApp">
                                    <i class="fa-brands fa-whatsapp fa-lg ms-2"></i>
                                    {{ __('site.send_invitations_via_whatsApp') }}
                                </button>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <button type="button" class="btn-link" data-bs-toggle="modal"
                                    data-bs-target="#exampleModalQr">
                                    <i class="fa-solid fa-rotate-right fa-lg ms-2"></i>
                                    {{ __('site.send_undelivered_qr_codes') }}
                                </button>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <a class="text-decoration-none"
                                    href="{{ route('showUserScanned', $invitation->id) }}">
                                    <button type="button" class="btn-link">
                                        <i class="fa-solid fa-qrcode fa-lg ms-2"></i>
                                        {{ __('site.scan_management') }}
                                    </button>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <button type="button" class="btn-link btn-hand" data-content=".hand-invite">
                                    <i class="fa-solid fa-envelope fa-lg ms-2"></i>
                                    {{ __('site.send_invitations_manually') }}
                                </button>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12 mb-3">
                                <a class="text-decoration-none" href="{{ route('reminder', $invitation->id) }}">
                                    <button type="button" class="btn-link">
                                        <i class="fa-solid fa-bell fa-lg ms-2"></i>
                                        {{ __('site.send_a_reminder') }}
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
                                                    <th scope="col">{{ __('site.the_name') }}</th>
                                                    <th scope="col">{{ __('site.email') }}</th>
                                                    <th scope="col">{{ __('site.the_status') }}</th>
                                                    <th scope="col">{{ __('site.the_transmitter_is_manual') }}</th>
                                                </tr>
                                            </thead>

                                            <tbody>

                                                @if ($invitation->failed->isEmpty())
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            {{ __('site.there_is_no_information') }}
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
                                                                <a href="https://wa.me/920033007" target="_blank"
                                                                    class="whatsapp">
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

                                                    <th scope="col">{{ __('site.the_name') }}</th>
                                                    <th scope="col">{{ __('site.email') }}</th>
                                                    <th scope="col">{{ __('site.phone') }}</th>
                                                    <th scope="col">{{ __('site.the_status') }}</th>

                                            </thead>
                                            <tbody>

                                                @if ($invitation->scanned->isEmpty())
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            {{ __('site.there_is_no_information') }}
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
                                    {{-- end div of table --}}



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
                                    {{-- end div of table --}}


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
                                    {{-- end div of table --}}




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
                                    {{-- end div of table --}}


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
                                                            <td scope="row">{{ $userNotSent->id }}</td>
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
                                    {{-- end div of table --}}


                                    {{-- start read of whatsapp status --}}

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
                                                            <td scope="row">{{ $not_sent_whatsapp->invitee->id }}
                                                            </td>
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
                                    {{-- end div of table --}}



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
                                                            <td scope="row">{{ $received_whatsapp->invitee->id }}
                                                            </td>
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
                                    {{-- end div of table --}}




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
                                                            <td scope="row">{{ $readIt_whatsapp->invitee->id }}
                                                            </td>
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
                                    {{-- end div of table --}}



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
                                                            <td scope="row">{{ $faild_whatsapp->invitee->id }}
                                                            </td>
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
                                    {{-- end div of table --}}


                                    {{-- start read of Qr status --}}
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
                                                            <td scope="row">{{ $not_received_qr->invitee->id }}
                                                            </td>
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
                                    {{-- end div of table --}}



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
                                                            <td scope="row">{{ $received_qr->invitee->id }}</td>
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
                                    {{-- end div of table --}}




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
                                                            <td scope="row">{{ $read_it_qr->invitee->id }}</td>
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
                                    {{-- end div of table --}}



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
                                                            <td scope="row">{{ $faild_qr->invitee->id }}</td>
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
                                    {{-- end div of table --}}





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
                <h5 class="modal-title">{{ __('site.confirm_deletion') }}</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {{ __('site.are_you_sure_you_want_to_delete') }}: <input type="hidden" id="invitationId">
                <span class=" text-danger" id="invitationTitle"></span>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('site.no') }}</button>
                <button type="button" class="btn btn-danger" id="deleteButton">{{ __('site.delete') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Delete -->

@include('Admin/layouts/myAjaxHelper')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $('#editBtnInvite').on('click', function() {
        let id = $(this).data('id');
        let url = "{{ route('editInvitation', ':id') }}";
        url = url.replace(':id', id);
        location.href = url;
    })

    // function to get invitation id and title
    $(document).ready(function() {
        $('#exampleModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var invitationId = button.data('invitation-id');
            var invitationTitle = button.data('invitation-title');

            $('#invitationId').text(invitationId);
            $('#invitationTitle').text(invitationTitle);
            console.log(invitationTitle);
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

    function searchInvitations(query) {
        // Get the user ID from the input's data attribute
        var userId = $(".form-control").data("user-id");

        // Check if the query is empty
        if (query === '') {
            $('.default').removeClass('d-none');
            $('.search-results').addClass('hidden'); // Hide search results
        } else {
            $('.default').addClass('d-none');
            $('.search-results').removeClass('d-none'); // Show search results
        }

        // Make an AJAX request to the server-side endpoint
        $.ajax({
            method: "GET",
            url: "/search/invitations", // Replace with your actual search endpoint URL
            data: {
                query: query,
                user_id: userId
            },
            dataType: "json",
            success: function(response) {
                // Handle the successful response and display the search results
                displaySearchResults(response);
            },
            error: function(error) {
                // Handle errors, e.g., display an error message
                console.error("Error during search:", error);
            }
        });
    }

    function displaySearchResults(results) {
        // Get the container where the search results will be displayed
        var resultsContainer = $("#search-results");

        // Clear the previous search results
        resultsContainer.empty();

        // Check if there are any results
        if (results && results.length > 0) {

            // Iterate through the results and create HTML elements to display them
            results.forEach(function(result) {
                var invitationHtml = '<div class="invitation">' +
                    '<div class="card-invite mt-2" id="dataContainer">' +
                    '<button class="btn-faq d-flex justify-content-between align-items-center w-100" data-bs-toggle="collapse" data-bs-target="#collapseExample' +
                    result.id + '" aria-expanded="false" aria-controls="collapseExample' + result.id + '">' +
                    '<div class="row" style="width: 50%;">' +
                    '<div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center">' +
                    '<h5>' + result.title + '</h5>' +
                    '</div>' +
                    '<div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center">' +
                    '<p style="' + (result.status == 0 ? 'background-color: #E9EAEB; color: black;' : '') +
                    '" class="btn-active">' +
                    result.status + ' ' + (result.status == 1 ? "{{ __('site.confirmed') }}" :
                        "{{ __('site.un_confirmed') }}") +
                    '</p>' +
                    '</div>' +
                    '<div class="col-lg-4 col-md-6 col-12 d-flex justify-content-center align-items-center">' +
                    '<p>' + result.date + '</p>' +
                    '</div>' +
                    '<div class="faq-icon" id="icon1">' +
                    '<i class="fa-solid fa-angle-down"></i>' +
                    '</div>' +
                    '</div>' +
                    '</button>' +
                    '<div class="collapse" id="collapseExample' + result.id + '">' +
                    '<div class="row mt-4">' +
                    '<div class="col-lg-3 col-12 mb-2">' +
                    '<img src="' + result.image + '" alt="no-image" class="image-details">' +
                    '</div>' +
                    '<div class="col-lg-7 col-12">' +
                    '<div class="d-flex mb-2">' +
                    '<div class="color2 ms-2"><i class="fa-solid fa-location-dot"></i></div>' +
                    '<div>' + result.address + '</div>' +
                    '</div>' +
                    '<div class="d-flex mb-2">' +
                    '<div class="color2 ms-2"><i class="fa-solid fa-calendar-days"></i></div>' +
                    '<div>' + result.date + '</div>' +
                    '</div>' +
                    '<div class="d-flex mb-2">' +
                    '<div class="color2 ms-2"><i class="fa-solid fa-lock"></i></div>' +
                    '<div>كلمة المرور للتطبيق</div>' +
                    '</div>' +
                    '<p>' + result.password + '</p>' +
                    '<div style="margin-top: 35px;">' +
                    '<a href="#" class="text-decoration-none btn-login">{{ __('SITE.download_the_app') }}</a>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-1 col-6 d-flex justify-content-end">' +
                    '<button type="button" class="btn btn-primary fa-solid fa-pen-to-square" id="editBtnInvite" data-id="' +
                    result.id + '"></button>' +
                    '</div>' +
                    '<div class="col-lg-1 col-6">' +
                    '<div class="delete">' +
                    '<button type="button" class="btn btn-primary fa-solid fa-trash-can" data-toggle="modal" data-target="#exampleModal" data-invitation-id="' +
                    result.id + '" data-invitation-title="' + result.title + '"></button>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="mt-5">' +
                    '<h6 class="mb-2">{{ __('site.contact_statuses') }}</h6>' +
                    '<div class="row">' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number text-center btn-hand" data-content=".single-table">' +
                    '<p class="mb-0">{{ @$invitation->scanned->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.scanned') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number text-center btn-hand" data-content=".confirmed">' +
                    '<p class="mb-0">{{ @$invitation->confirmed->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.confirm') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number text-center btn-hand" data-content=".apologized">' +
                    '<p class="mb-0">{{ @$invitation->apologized->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.apology') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number text-center">' +
                    '<p class="mb-0">1</p>' +
                    '<p class="mb-0">{{ __('site.visited_the_page') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number text-center btn-hand" data-content=".waiting">' +
                    '<p class="mb-0">{{ @$invitation->waiting->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.no_answer') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number text-center btn-hand" data-content=".failed">' +
                    '<p class="mb-0">{{ @$invitation->apologized->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.to_fail') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number text-center btn-hand" data-content=".not-send">' +
                    '<p class="mb-0">{{ @$invitation->failed->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.they_havent_called_yet') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="mt-4">' +
                    '<h6 class="mb-2">{{ __('site.whatsApp_invitation_statuses') }}</h6>' +
                    '<div class="row">' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number bg-color1 text-center btn-hand" data-content=".not-sent-whatsapp">' +
                    '<p class="mb-0">{{ @$invitation->not_sent_whatsapp->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.did_not_send') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number bg-color1 text-center btn-hand" data-content=".received-whatsapp">' +
                    '<p class="mb-0">{{ @$invitation->received_whatsapp->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.it_was_received') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number bg-color1 text-center btn-hand" data-content=".readIt-whatsapp">' +
                    '<p class="mb-0">{{ @$invitation->readIt_whatsapp->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.read') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number bg-color1 text-center btn-hand" data-content=".faild-whatsapp">' +
                    '<p class="mb-0">{{ $invitation->faild_whatsapp->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.to_fail') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="mt-4">' +
                    '<h6 class="mb-2">{{ __('site.qr_code_delivery_statuses') }}</h6>' +
                    '<div class="row">' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number bg-color2 text-center btn-hand" data-content=".not-received-qr">' +
                    '<p class="mb-0">{{ $invitation->not_received_qr->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.there_is_no_delivery_status') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number bg-color2 text-center btn-hand" data-content=".received-qr">' +
                    '<p class="mb-0">{{ $invitation->received_qr->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.it_was_received') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number bg-color2 text-center btn-hand" data-content=".read-it-qr">' +
                    '<p class="mb-0">{{ $invitation->read_it_qr->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.read') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-lg-3 col-md-4 col-sm-6 col-12">' +
                    '<div class="details-number bg-color2 text-center btn-hand" data-content=".faild-qr">' +
                    '<p class="mb-0">{{ $invitation->faild_qr->count() }}</p>' +
                    '<p class="mb-0">{{ __('site.to_fail') }}</p>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row mt-4">' +
                    '<div class="col-lg-4 col-md-6 col-12 mb-3">' +
                    '<button type="button" class="btn-link btn-link-bg" data-bs-toggle="modal" data-bs-id="{{ $invitation->id }}" data-bs-target="#modalWhatsApp">' +
                    '<i class="fa-brands fa-whatsapp fa-lg ms-2"></i>' +
                    '{{ __('site.send_invitations_via_whatsApp') }}' +
                    '</button>' +
                    '</div>' +
                    '<div class="col-lg-4 col-md-6 col-12 mb-3">' +
                    '<button type="button" class="btn-link" data-bs-toggle="modal" data-bs-target="#exampleModalQr">' +
                    '<i class="fa-solid fa-rotate-right fa-lg ms-2"></i>' +
                    '{{ __('site.send_undelivered_qr_codes') }}' +
                    '</button>' +
                    '</div>' +
                    '<div class="col-lg-4 col-md-6 col-12 mb-3">' +
                    '<a class="text-decoration-none" href="{{ route('showUserScanned', $invitation->id) }}">' +
                    '<button type="button" class="btn-link">' +
                    '<i class="fa-solid fa-qrcode fa-lg ms-2"></i>' +
                    '{{ __('site.scan_management') }}' +
                    '</button>' +
                    '</a>' +
                    '</div>' +
                    '<div class="col-lg-4 col-md-6 col-12 mb-3">' +
                    '<button type="button" class="btn-link btn-hand" data-content=".hand-invite">' +
                    '<i class="fa-solid fa-envelope fa-lg ms-2"></i>' +
                    '{{ __('site.send_invitations_manually') }}' +
                    '</button>' +
                    '</div>' +
                    '<div class="col-lg-4 col-md-6 col-12 mb-3">' +
                    '<a class="text-decoration-none" href="{{ route('reminder', $invitation->id) }}">' +
                    '<button type="button" class="btn-link">' +
                    '<i class="fa-solid fa-bell fa-lg ms-2"></i>' +
                    '{{ __('site.send_a_reminder') }}' +
                    '</button>' +
                    '</a>' +
                    '</div>' +
                    '</div>' +
                    '<div class="col-12 mt-5">' +
                    '<div class="content-list">' +
                    '<div class="scroll hand-invite failed">' +
                    '<table class="table table-striped border">' +
                    '<thead>' +
                    '<tr>' +
                    '<th scope="col">#</th>' +
                    '<th scope="col">{{ __('site.the_name') }}</th>' +
                    '<th scope="col">{{ __('site.email') }}</th>' +
                    '<th scope="col">{{ __('site.the_status') }}</th>' +
                    '<th scope="col">{{ __('site.the_transmitter_is_manual') }}</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '@if ($invitation->failed->isEmpty())' +
                    '<tr>' +
                    '<td colspan="5" class="text-center">{{ __('site.there_are_no_failed_invitations') }}</td>' +
                    '</tr>' +
                    '@else' +
                    '@php $i=0; @endphp' +
                    '@foreach ($invitation->failed as $row)' +
                    '@php $i++ @endphp' +
                    '<tr>' +
                    '<td>{{ $i }}</td>' +
                    '<td>{{ $row->full_name }}</td>' +
                    '<td>{{ $row->email }}</td>' +
                    '<td>{{ __('site.to_fail') }}</td>' +
                    '<td>{{ __('site.no') }}</td>' +
                    '</tr>' +
                    '@endforeach' +
                    '@endif' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="scroll hand-invite not-send">' +
                    '<table class="table table-striped border">' +
                    '<thead>' +
                    '<tr>' +
                    '<th scope="col">#</th>' +
                    '<th scope="col">{{ __('site.the_name') }}</th>' +
                    '<th scope="col">{{ __('site.email') }}</th>' +
                    '<th scope="col">{{ __('site.the_status') }}</th>' +
                    '<th scope="col">{{ __('site.the_transmitter_is_manual') }}</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '@if ($invitation->waiting->isEmpty())' +
                    '<tr>' +
                    '<td colspan="5" class="text-center">{{ __('site.there_are_no_not_sent_invitations') }}</td>' +
                    '</tr>' +
                    '@else' +
                    '@php $i=0; @endphp' +
                    '@foreach ($invitation->waiting as $row)' +
                    '@php $i++ @endphp' +
                    '<tr>' +
                    '<td>{{ $i }}</td>' +
                    '<td>{{ $row->full_name }}</td>' +
                    '<td>{{ $row->email }}</td>' +
                    '<td>{{ __('site.no_answer') }}</td>' +
                    '<td>{{ __('site.no') }}</td>' +
                    '</tr>' +
                    '@endforeach' +
                    '@endif' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="scroll hand-invite received-whatsapp">' +
                    '<table class="table table-striped border">' +
                    '<thead>' +
                    '<tr>' +
                    '<th scope="col">#</th>' +
                    '<th scope="col">{{ __('site.the_name') }}</th>' +
                    '<th scope="col">{{ __('site.mobile') }}</th>' +
                    '<th scope="col">{{ __('site.the_status') }}</th>' +
                    '<th scope="col">{{ __('site.the_transmitter_is_manual') }}</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '@if ($invitation->received_whatsapp->isEmpty())' +
                    '<tr>' +
                    '<td colspan="5" class="text-center">{{ __('site.there_are_no_received_invitations') }}</td>' +
                    '</tr>' +
                    '@else' +
                    '@php $i=0; @endphp' +
                    '@foreach ($invitation->received_whatsapp as $row)' +
                    '@php $i++ @endphp' +
                    '<tr>' +
                    '<td>{{ $i }}</td>' +
                    '<td>{{ $row->full_name }}</td>' +
                    '<td>{{ $row->mobile }}</td>' +
                    '<td>{{ __('site.it_was_received') }}</td>' +
                    '<td>{{ __('site.yes') }}</td>' +
                    '</tr>' +
                    '@endforeach' +
                    '@endif' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="scroll hand-invite not-sent-whatsapp">' +
                    '<table class="table table-striped border">' +
                    '<thead>' +
                    '<tr>' +
                    '<th scope="col">#</th>' +
                    '<th scope="col">{{ __('site.the_name') }}</th>' +
                    '<th scope="col">{{ __('site.mobile') }}</th>' +
                    '<th scope="col">{{ __('site.the_status') }}</th>' +
                    '<th scope="col">{{ __('site.the_transmitter_is_manual') }}</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '@if ($invitation->not_sent_whatsapp->isEmpty())' +
                    '<tr>' +
                    '<td colspan="5" class="text-center">{{ __('site.there_are_no_not_sent_invitations') }}</td>' +
                    '</tr>' +
                    '@else' +
                    '@php $i=0; @endphp' +
                    '@foreach ($invitation->not_sent_whatsapp as $row)' +
                    '@php $i++ @endphp' +
                    '<tr>' +
                    '<td>{{ $i }}</td>' +
                    '<td>{{ $row->full_name }}</td>' +
                    '<td>{{ $row->mobile }}</td>' +
                    '<td>{{ __('site.did_not_send') }}</td>' +
                    '<td>{{ __('site.yes') }}</td>' +
                    '</tr>' +
                    '@endforeach' +
                    '@endif' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="scroll received-whatsapp">' +
                    '<table class="table table-striped border">' +
                    '<thead>' +
                    '<tr>' +
                    '<th scope="col">#</th>' +
                    '<th scope="col">الاسم</th>' +
                    '<th scope="col">البريد الالكترونى</th>' +
                    '<th scope="col">الهاتف</th>' +
                    '<th scope="col"> الحالة</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '@if ($invitation->received_whatsapp->isEmpty())' +
                    '<tr>' +
                    '<td colspan="5" class="text-center">لا يوجد معلومات</td>' +
                    '</tr>' +
                    '@else' +
                    '@php $i=0; @endphp' +
                    '@foreach ($invitation->received_whatsapp as $received_whatsapp)' +
                    '@php $i++ @endphp' +
                    '<tr>' +
                    '<td scope="row">{{ $received_whatsapp->invitee->id }}</td>' +
                    '<td>{{ $received_whatsapp->invitee->name }}</td>' +
                    '<td>{{ $received_whatsapp->invitee->email }}</td>' +
                    '<td>{{ $received_whatsapp->invitee->phone }}</td>' +
                    '<td>Received</td>' +
                    '</tr>' +
                    '@endforeach' +
                    '@endif' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="scroll readIt-whatsapp">' +
                    '<table class="table table-striped border">' +
                    '<thead>' +
                    '<tr>' +
                    '<th scope="col">#</th>' +
                    '<th scope="col">الاسم</th>' +
                    '<th scope="col">البريد الالكترونى</th>' +
                    '<th scope="col">الهاتف</th>' +
                    '<th scope="col"> الحالة</th>' +
                    '</tr>' +
                    '</thead>' +
                    '<tbody>' +
                    '@if ($invitation->readIt_whatsapp->isEmpty())' +
                    '<tr>' +
                    '<td colspan="5" class="text-center">لا يوجد معلومات</td>' +
                    '</tr>' +
                    '@else' +
                    '@foreach ($invitation->readIt_whatsapp as $readIt_whatsapp)' +
                    '<tr>' +
                    '<td scope="row">{{ $readIt_whatsapp->invitee->id }}' +
                    '</td>' +
                    '<td>{{ '+ result.name +' }}</td>' +
                    '<td>{{ '+ result.email +' }}</td>' +
                    '<td>{{ '+ result.phone +' }}</td>' +
                    '<td>Read</td>' +
                    '</tr>' +
                    '@endforeach' +
                    '@endif' +
                    '</tbody>' +
                    '</table>' +
                    '</div>' +
                    '<div class="scroll faild-whatsapp">' +
                    '<table class="table table-striped border">' +
                    '<thead>' +
                    '<tr>' +
                    '<th scope="col">#</th>' +
                    '<th scope="col">الاسم</th>'
                '<th scope="col">البريد الالكترونى</th>' +
                '<th scope="col">الهاتف</th>' +
                '<th scope="col"> الحالة</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '@if ($invitation->faild_whatsapp->isEmpty())' +
                '<tr>' +
                '<td colspan="5" class="text-center">لا يوجد معلومات' +
                '</td>' +
                '</tr>' +
                '@else' +
                '@foreach ($invitation->faild_whatsapp as $faild_whatsapp)' +
                '<tr>' +
                '<td scope="row">{{ $faild_whatsapp->invitee->id }}' +
                '</td>' +
                '<td>{{ $faild_whatsapp->invitee->name }}</td>' +
                '<td>{{ $faild_whatsapp->invitee->email }}</td>' +
                '<td>{{ $faild_whatsapp->invitee->phone }}</td>' +
                '<td>Failed </td>' +
                '</tr>' +
                '@endforeach' +
                '@endif' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '<div class="scroll not-received-qr">' +
                '<table class="table table-striped border">' +
                '<thead>' +
                '<tr>' +
                '<th scope="col">#</th>' +
                '<th scope="col">الاسم</th>' +
                '<th scope="col">البريد الالكترونى</th>' +
                '<th scope="col">الهاتف</th>' +
                '<th scope="col"> الحالة</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '@if ($invitation->not_received_qr->isEmpty())' +
                '<tr>' +
                '<td colspan="5" class="text-center">لا يوجد معلومات' +
                '</td>' +
                '</tr>' +
                '@else' +
                '@foreach ($invitation->not_received_qr as $not_received_qr)' +
                '<tr>' +
                '<td scope="row">{{ $not_received_qr->invitee->id }}' +
                '</td>' +
                '<td>{{ $not_received_qr->invitee->name }}</td>' +
                '<td>{{ $not_received_qr->invitee->email }}</td>' +
                '<td>{{ $not_received_qr->invitee->phone }}</td>' +
                '<td>not received qr</td>' +
                '</tr>' +
                '@endforeach' +
                '@endif' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '<div class="scroll received-qr">' +
                '<table class="table table-striped border">' +
                '<thead>' +
                '<tr>' +
                '<th scope="col">#</th>' +
                '<th scope="col">الاسم</th>' +
                '<th scope="col">البريد الالكترونى</th>' +
                '<th scope="col">الهاتف</th>' +
                '<th scope="col"> الحالة</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '@if ($invitation->received_qr->isEmpty())' +
                '<tr>' +
                '<td colspan="5" class="text-center">لا يوجد معلومات' +
                '</td>' +
                '</tr>' +
                '@else' +
                '@foreach ($invitation->received_qr as $received_qr)' +
                '<tr>' +
                '<td scope="row">{{ $received_qr->invitee->id }}</td>' +
                '<td>{{ $received_qr->invitee->name }}</td>' +
                '<td>{{ $received_qr->invitee->email }}</td>' +
                '<td>{{ $received_qr->invitee->phone }}</td>' +
                '<td> received qr </td>' +
                '</tr>' +
                '@endforeach' +
                '@endif' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '<div class="scroll read-it-qr">' +
                '<table class="table table-striped border">' +
                '<thead>' +
                '<tr>' +
                '<th scope="col">#</th>' +
                '<th scope="col">الاسم</th>' +
                '<th scope="col">البريد الالكترونى</th>' +
                '<th scope="col">الهاتف</th>' +
                '<th scope="col"> الحالة</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '@if ($invitation->read_it_qr->isEmpty())' +
                '<tr>' +
                '<td colspan="5" class="text-center">لا يوجد معلومات' +
                '</td>' +
                '</tr>' +
                '@else' +
                '@foreach ($invitation->read_it_qr as $read_it_qr)' +
                '<tr>' +
                '<td scope="row">{{ $read_it_qr->invitee->id }}</td>' +
                '<td>{{ $read_it_qr->invitee->name }}</td>' +
                '<td>{{ $read_it_qr->invitee->email }}</td>' +
                '<td>{{ $read_it_qr->invitee->phone }}</td>' +
                '<td> read it qr </td>' +
                '</tr>' +
                '@endforeach' +
                '@endif' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '<div class="scroll faild-qr">'
                '<table class="table table-striped border">'
                '<thead>'
                '<tr>'
                '<th scope="col">#</th>' +
                '<th scope="col">الاسم</th>' +
                '<th scope="col">البريد الالكترونى</th>' +
                '<th scope="col">الهاتف</th>' +
                '<th scope="col"> الحالة</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody>' +
                '@if ($invitation->faild_qr->isEmpty())' +
                '<tr>' +
                '<td colspan="5" class="text-center">لا يوجد معلومات' +
                '</td>' +
                '</tr>' +
                '@else' +
                '@foreach ($invitation->faild_qr as $faild_qr)' +
                '<tr>' +
                '<td scope="row">{{ $faild_qr->invitee->id }}</td>' +
                '<td>{{ $faild_qr->invitee->name }}</td>' +
                '<td>{{ $faild_qr->invitee->email }}</td>' +
                '<td>{{ $faild_qr->invitee->phone }}</td>' +
                '<td> failed qr </td>' +
                '</tr>' +
                '@endforeach' +
                '@endif' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>'; // Closing tags for the "invitationHtml" variable

                // Now you have the fixed "invitationHtml" variable with all the necessary concatenations and correct formatting.

                // Append the invitation HTML to the results container
                resultsContainer.append(invitationHtml);
            });
        } else {
            // If no results found, display a message
            resultsContainer.append('<h3>{{ __('site.no_invitations_found') }}</h3>');
        }
    }
</script>
