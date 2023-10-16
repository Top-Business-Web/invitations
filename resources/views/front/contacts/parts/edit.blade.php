<div class="modal-body">
    <form id="updateForm" method="POST" enctype="multipart/form-data" action="{{route('contact.update',$find->id)}}" >
    @csrf
        @method('PUT')
        <input type="hidden" value="{{$find->id}}" name="id">

        <div class="col-12">
            <label class="form-label">اللقب </label>
            <input type="text" value="{{$find->surname}}" name="surname" class="form-control" required>
        </div>
        <div class="col-12">
            <label class="form-label"> الاسم</label>
            <input type="text" value="{{$find->name}}" name="name" class="form-control" required>
        </div>
        <div class="col-12">
            <label class="form-label"> البريد الالكترونى</label>
            <input type="email" value="{{$find->email}}" name="email" class="form-control">
        </div>
        <div class="col-12">
            <label class="form-label"> الهاتف</label>
            <input type="text" value="{{$find->phone}}" name="phone" class="form-control" required>
        </div>


        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
            <button type="submit" class="btn btn-success" id="updateButton">{{__('admin.update')}}</button>
        </div>
    </form>
</div>
<script>
    $('.dropify').dropify()
</script>
