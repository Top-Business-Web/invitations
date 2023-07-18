<form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{ route('Invitations.create') }}">
    @csrf
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="image" class="form-control-label">الصورة</label>
                <input type="file" class="dropify" name="image"
                    accept="image/png, image/gif, image/jpeg,image/jpg" />
                <span class="form-text text-danger text-center">مسموح بالصيغ الاتية png, gif, jpeg, jpg</span>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                {!! QrCode::size(100)->generate('https://techvblogs.com/blog/generate-qr-code-laravel-8') !!}
                {{--  <label for="btn_title_en" class="form-control-label">Qr Code</label>
                <input type="text" class="form-control" name="address">  --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="title" class="form-control-label">عنوان الدعوة</label>
                <input type="text" class="form-control" name="ttile">
            </div>
        </div>

        <div class="col-6">
            <div class="form-group">
                <label for="date" class="form-control-label">تاريخ</label>
                <input type="date" class="form-control" name="date">
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="address" class="form-control-label">مكان</label>
                <textarea type="text" rows="8" class="form-control" name="address"> </textarea>
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="btn_title_en" class="form-control-label">خط الطول</label>
                <input type="text" class="form-control" name="longitude" />
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="latitude" class="form-control-label">خط العرض</label>
                <input type="text" class="form-control" name="latitude" />
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="btn_link" class="form-control-label">كلمة السر</label>
                <input type="password" class="form-control" name="password" placeholder="******">
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
