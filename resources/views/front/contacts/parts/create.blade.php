<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('contact.store')}}" >
    @csrf
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">اللقب </label>
                <input type="text" name="surname" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label"> الاسم</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label"> البريد الالكترونى</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label"> الهاتف</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3 mb-3">
            <a href="#" class="text-decoration-none btn-login bg-hover"> الغاء</a>
            <button class="main-btn1 bg-hover"> حفظ</button>
        </div>
{{--        <div class="modal-footer">--}}
{{--            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>--}}
{{--            <button type="submit" class="btn btn-primary" id="addButton">اضافة</button>--}}
{{--        </div>--}}
    </form>
</div>

<script>
    $('.dropify').dropify()
</script>
