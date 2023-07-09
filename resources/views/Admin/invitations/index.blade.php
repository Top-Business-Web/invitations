@extends('Admin/layouts/master')

@section('title')
    {{ $setting->title ?? '' }} | الدعوات
@endsection
@section('page_name')
    الدعوات
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title"> الدعوات {{ $setting->title ?? '' }}</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-striped table-bordered text-nowrap w-100" id="dataTable">
                            <thead>
                                <tr class="fw-bolder text-muted bg-light">
                                    <th class="min-w-25px">#</th>
                                    <th class="min-w-50px">عنوان الدعوة</th>
                                    <th class="min-w-50px">التاريخ</th>
                                    <th class="min-w-50px">الصورة</th>
                                    <th class="min-w-50px">باركود</th>
                                    <th class="min-w-50px">مكان</th>
                                    <th class="min-w-50px">موقع</th>
                                    <th class="min-w-50px">عدد المدعوين</th>
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
                data: 'title',
                name: 'title'
            },
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'image',
                name: 'image'
            },
            {
                data: 'qrcode',
                name: 'qrcode'
            },
            {
                data: 'address',
                name: 'address'
            },
            {
                data: 'latitude',
                name: 'latitude'
            },
            {
                data: 'invitees',
                name: 'invitees'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
        showData('{{ route('invitationsUsers', request()->segment(3)) }}', columns);
        // Delete Using Ajax
        destroyScript('{{ route('Invitations.destroy', ':id') }}');
        // Add Using Ajax
        showAddModal('{{ route('Invitations.create') }}');
        addScript();
        // Add Using Ajax
        showEditModal('{{ route('Invitations.edit', ':id') }}');
        editScript();

        function activeInvitation(element) {
            var id = element.getAttribute('data-id');
            var csrfToken = '{{ csrf_token() }}';

            $.ajax({
                type: 'POST',
                url: '{{ route('updateStatus') }}',
                data: {
                    id: id
                },
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    if (response.status === 'success') {
                        if (response.newStatus === "1") {
                            toastr.success('تم تفعيل الدعوة بنجاح');
                        } else {
                            toastr.success('تم إلغاء تفعيل الدعوة بنجاح');
                        }
                        setTimeout(function() {
                            location.reload();
                        }, 2000);
                    } else {
                        toastr.error('لم يتم تفعيل الدعوة بنجاح');
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    toastr.error('هناك خطأ ما');
                }
            });
        }
    </script>
@endsection
