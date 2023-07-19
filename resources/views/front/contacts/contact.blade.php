<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('front.layouts.head')
<style>
    .overflow-hidden {
        overflow: hidden;
    }
</style>
<body>
    @include('front.layouts.my_nav')

    <div class="section pt-5 pb-5">
        <div class="container">
            <div class="d-flex justify-content-between mb-4">
                <h3>جهات الاتصال</h3>
                <div class="d-flex flex-column">
                    <button type="button" class="main-btn1 mb-2 addBtn" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        اضافة جهة الاتصال
                    </button>
                    <a href="{{ route('contacts.showExcel') }}" class="text-decoration-none">
                        <button type="button" class="main-btn1 bg-color">استيراد</button>
                    </a>
                </div>
            </div>
            <div class="row mt-5">
{{--                <div class="col-lg-4 col-md-5 col-sm-6 col-12 mb-2">--}}
{{--                    <input class="form-control" type="search" placeholder="بحث">--}}
{{--                </div>--}}
            </div>
            <div class="p-3 bg-white">
                <div class="scroll">
                    <table class="table table-striped border overflow-hidden" id="dataTable">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الاسم</th>
                            <th scope="col">البريد الالكترونى</th>
                            <th scope="col">الهاتف</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal add contact -->
    <div class="modal fade" id="editOrCreate" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modal-body">

                </div>
            </div>
        </div>
    </div>


    <!-- Modal delete contact -->
    <div class="modal fade" id="delete_modal" tabindex="-1"  aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="p-2">
                    <button type="button" class="btn-close" id="dismiss_delete_modal" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

{{--                <div class="modal-body" id="modal-body">--}}

                    <div class="modal-body">
                        <input id="delete_id" name="id" type="hidden">
                        <p>هل انت متأكد من حذف البيانات التالية <span id="title" class="text-danger"></span>؟</p>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-danger" id="delete_btn">حذف !</button>
                    </div>
{{--                </div>--}}
            </div>
        </div>
    </div>

    @include('front.layouts.scripts')
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="http://someothersite.com/external.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <script type="text/javascript" src="https://cdn.datatables.net/1.10.8/js/jquery.dataTables.min.js"></script>

    @include('Admin/layouts/myAjaxHelper')
    <script>
        var columns = [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        showData('{{route('contact.index')}}', columns);
        // Delete Using Ajax
        destroyScript('{{route('contact.destroy',':id')}}');
        // Add Using Ajax
        showAddModal('{{route('contact.create')}}');
        addScript();
        {{--// Add Using Ajax--}}
        showEditModal('{{route('contact.edit',':id')}}');
        editScript();
    </script>


</body>

</html>
