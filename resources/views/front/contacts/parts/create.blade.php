<div class="modal-body">
    <form id="addForm" class="addForm" method="POST" enctype="multipart/form-data" action="{{route('contact.store')}}" >
    @csrf
        <div class="row g-3">
            <div class="col-12">
                <label class="form-label">{{ __('site.surname') }}</label>
                <select name="surname" class="form-control">
                    <option value="doctor">الدكتور/ة</option>
                    <option value="engineer">المهندس/ة</option>
                    <option value="sheikh">الشيخ/ة</option>
                    <option value="honorable_one">المكرم/ة</option>
                </select>
            </div>
            <div class="col-12">
                <label class="form-label">{{ __('site.the_name') }}</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-12">
                <label class="form-label">{{ __('site.email') }}</label>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label">{{ __('site.phone') }}</label>
                <input type="text" name="phone" class="form-control" required>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3 mb-3">
            <a href="#" class="text-decoration-none btn-login bg-hover">{{ __('site.cancellation') }}</a>
            <button class="main-btn1 bg-hover">{{ __('site.save') }}</button>
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
