<form id="updateForm" method="POST" enctype="multipart/form-data" action="{{ route('users.update_points', $user->id) }}">
    @csrf
{{--    @method('PUT')--}}

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                <label for="btn_title_ar" class="form-control-label">عدد الدعوات الاضافية</label>
                <input type="number" class="form-control" name="invitations_number" >
            </div>
        </div>

    </div>

    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
        <button type="submit" class="btn btn-success" id="updateButton">اضافة</button>
    </div>
</form>
<script>
    $('.dropify').dropify()
</script>
