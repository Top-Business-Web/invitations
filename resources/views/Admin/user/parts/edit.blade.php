<form id="updateForm" method="POST" enctype="multipart/form-data" action="{{ route('users.update', $user->id) }}">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="image" class="form-control-label">الصورة</label>
                <input type="file" class="dropify" name="image" data-default-file="{{ $user->image }}"
                    accept="image/png, image/gif, image/jpeg,image/jpg" />
                <span class="form-text text-danger text-center">مسموح بالصيغ الاتية png, gif, jpeg, jpg</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="btn_title_ar" class="form-control-label">اسم المستخدم</label>
                <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="btn_title_en" class="form-control-label">رقم الهاتف</label>
                <input type="text" class="form-control" value="{{ $user->phone }}" name="phone">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-group">
                <label for="btn_title_en" class="form-control-label">الايميل</label>
                <input type="text" class="form-control" name="email" value="{{ $user->email }}">
            </div>
        </div>
        <div class="col-6">
            <div class="form-group">
                <label for="password" class="form-control-label">كلمة السر</label>
                <input type="password" class="form-control" value="{{ $user->password }}" name="password">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="btn_title_en" class="form-control-label">العنوان</label>
                <textarea type="text" rows="8" class="form-control" name="address">{{ $user->address }}</textarea>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        <button type="submit" class="btn btn-success" id="updateButton">تعديل</button>
    </div>
</form>
<script>
    $('.dropify').dropify()
</script>
