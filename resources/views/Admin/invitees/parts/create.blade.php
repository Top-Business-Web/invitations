<form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{ route('Invitations.create') }}">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="image" class="form-control-label">الصورة</label>
                <input type="file" class="dropify" name="image"
                    accept="image/png, image/gif, image/jpeg,image/jpg" />
                <span class="form-text text-danger text-center">مسموح بالصيغ الاتية png, gif, jpeg,
                    jpg</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="image" class="form-control-label">عنوان</label>
                <input type="text" class="form-control" name="title" />
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="check" class="form-control-label">ارسال مع كتابة اسم المدعو في الرسالة</label>
                <input type="checkbox" class="form-control" name="title" />
                <span class="form-text text-danger text-center">مثال: السيد اسامة</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="image" class="form-control-label">وصف</label>
                <textarea name="description" class="form-control" id="description" rows="8"></textarea>
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
