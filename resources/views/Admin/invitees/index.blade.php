@extends('Admin/layouts/master')

@section('title')
    {{ $setting->title ?? '' }} | جميع المدعوين
@endsection
@section('page_name')
    جميع المدعوين
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> جميع المدعوين {{ $setting->title ?? '' }}</h3>
                    <div class="">
                        <button class="btn btn-secondary btn-icon text-white addBtn">
                            <span>
                                <i class="fe fe-plus"></i>
                            </span> رسالة للكل
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-bordered text-nowrap w-100" id="dataTable">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th class="min-w-25px">#</th>
                                    <th class="min-w-50px">رقم الدعوة</th>
                                    <th class="min-w-50px">الاسم</th>
                                    <th class="min-w-50px">هاتف</th>
                                    <th class="min-w-50px rounded-end">العمليات</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!--Delete MODAL -->
        <div class="modal fade" id="delete_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف بيانات</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input id="delete_id" name="id" type="hidden">
                        <p>هل انت متأكد من حذف البيانات التالية <span id="title" class="text-danger"></span>؟</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="dismiss_delete_modal">
                            اغلاق
                        </button>
                        <button type="button" class="btn btn-danger" id="delete_btn">حذف !</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL CLOSED -->

        <!-- Create Or Edit Modal -->
        <div class="modal fade bd-example-modal-lg" id="editOrCreate" data-backdrop="static" tabindex="-1" role="dialog"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3">اضافة دعوة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">

                    </div>
                </div>
            </div>
        </div>
        <!-- Create Or Edit Modal -->

        <!-- send message Modal -->
        <div class="modal fade bd-example-modal-lg" id="sendMessageUser" data-backdrop="static" tabindex="-1"
            role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="example-Modal3">ارسال رسالة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="modal-body">
                            <form id="addFormSendMessage" class="addFormSendMessage" method="POST" enctype="multipart/form-data"
                                action="{{ route('sendMessageToUser') }}">
                                @csrf
                                <input type="hidden" name="invitee_id" id="invitee_id">
                                <input type="hidden" name="invitation_id" id="invitation_id">
                                <input type="hidden" name="user_id" id="user_id">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="image" class="form-control-label">الصورة</label>
                                            <input type="file" id="image" class="dropify" name="image"
                                                accept="image/png, image/gif, image/jpeg,image/jpg" />
                                            <span class="form-text text-danger text-center">مسموح بالصيغ الاتية png, gif,
                                                jpeg,
                                                jpg</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="title" class="form-control-label">عنوان</label>
                                            <input type="text" id="title" class="form-control" name="title" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="check" class="form-control-label">ارسال مع كتابة اسم المدعو في
                                                الرسالة</label>
                                            <input type="checkbox" id="checked" class="form-control" name="status" />
                                            <span class="form-text text-danger text-center">مثال: السيد اسامة</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="body" class="form-control-label">وصف</label>
                                            <textarea name="body" id="description" class="form-control" id="body" rows="8"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <button type="submit" class="btn btn-primary" id="addButton">اضافة</button>
                                </div>
                            </form>
                            <script>
                                $('.dropify').dropify()
                            </script>

                    </div>
                </div>
            </div>
        </div>
        <!-- send message Modal -->
    </div>
    @include('Admin/layouts/myAjaxHelper')
@endsection
@section('ajaxCalls')
    <script>
        var columns = [{
                data: 'id',
                name: 'id'
            },
            {
                data: 'invitation_id',
                name: 'invitation_id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
        showData('{{ route('invitees.index') }}', columns);
        // Delete Using Ajax
        destroyScript('{{ route('invitees.destroy', ':id') }}');
        // Add Using Ajax
        showAddModal('{{ route('invitees.create') }}');
        addScript();
        // Add Using Ajax
        showEditModal('{{ route('invitees.edit', ':id') }}');
        editScript();

        function sendMessage(element) {
            var inviteeId = element.getAttribute('data-id');
            var invitationId = element.getAttribute('data-invitations');
            var userId = element.getAttribute('data-user-id');
            var csrfToken = '{{ csrf_token() }}';
            $('#invitee_id').val(inviteeId);
            $('#invitation_id').val(invitationId);
            $('#user_id').val(userId);
            $('#sendMessageUser').modal('show');
        }

        $(document).on('submit', 'Form#addFormSendMessage', function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = $('#addFormSendMessage').attr('action');
            $.ajax({
                url: url,
                type: 'POST',
                data: formData,
                beforeSend: function() {
                    $('#addButton').html('<span class="spinner-border spinner-border-sm mr-2" ' +
                        ' ></span> <span style="margin-left: 4px;">انتظر ..</span>').attr(
                        'disabled', true);
                },
                success: function(data) {
                    if (data.status == 200) {
                        $('#dataTable').DataTable().ajax.reload();
                        toastr.success('تم ارسال الرسالة بنجاح');
                    } else if (data.status == 405) {
                        toastr.error(data.mymessage);
                    } else
                        toastr.error('هناك خطأ ما ..');
                    $('#addButton').html(`اضافة`).attr('disabled', false);
                    $('#sendMessageUser').modal('hide')
                },
                error: function(data) {
                    if (data.status === 500) {
                        toastr.error('هناك خطأ ما ..');
                    } else if (data.status === 422) {
                        var errors = $.parseJSON(data.responseText);
                        $.each(errors, function(key, value) {
                            if ($.isPlainObject(value)) {
                                $.each(value, function(key, value) {
                                    toastr.error(value, 'خطأ');
                                });
                            }
                        });
                    } else
                        toastr.error('هناك خطأ ما ..');
                    $('#addButton').html(`اضافة`).attr('disabled', false);
                }, //end error method

                cache: false,
                contentType: false,
                processData: false
            });
        });
    </script>
@endsection
