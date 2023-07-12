<form id="addForm" class="addForm" method="POST" enctype="multipart/form-data"
    action="{{ route('sendMessageToAllUser') }}">
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
        <div class="col-12">
            <div class="form-group">
                <label for="image" class="form-control-label">المدعو</label>
                <select style="width: 450px;" class="form-control" name="invitee_id"
                    required="required">
                    @foreach ($invitees as $invite)
                        <option class="selectUser" value="{{ $invite->id }}">{{ $invite->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                <label for="image" class="form-control-label">مستخدم</label>
                <select style="width: 450px;" class="form-control" name="user_id[]" multiple="multiple"
                    required="required" id="selectUsers">
                    @foreach ($invitees as $invite)
                        <option class="selectUser" value="{{ $invite->invitation->user->id }}">{{ $invite->invitation->user->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="image" class="form-control-label">الكل</label>
                <input type="checkbox" class="form-control" name="allUsers" id="selectAllUsers">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="check" class="form-control-label">ارسال مع كتابة اسم المدعو في الرسالة</label>
                <input type="checkbox" class="form-control" name="mr" />
                <span class="form-text text-danger text-center">مثال: السيد اسامة</span>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="image" class="form-control-label">وصف</label>
                <textarea name="body" class="form-control" id="description" rows="8"></textarea>
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

    $(document).ready(function() {
        $('select').select2();
    });

    const selectUsers = document.getElementById('selectUsers');
    const selectAllUsers = document.getElementById('selectAllUsers');

    selectUsers.addEventListener('change', function() {
        selectAllUsers.disabled = selectUsers.options.length > 0;
    });

    selectAllUsers.addEventListener('change', function() {
        selectUsers.disabled = selectAllUsers.checked;
    });
</script>