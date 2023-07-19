<div class="section pt-5 pb-5">
    <div class="container">
        <div class="pt-5 pb-5 ps-3 pe-3 bg-white">
            <h3 class="mb-5">تذكير الدعوة</h3>
            <div class="scroll">
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">تحديد</th>
                            <th scope="col"> الاسم</th>
                            <th scope="col">البريد الالكترونى</th>
                            <th scope="col">الحالة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users_invitees_reminder as $user_invitee_reminder)
                            <tr>
                                <td scope="row">{{ $user_invitee_reminder->id }}</td>
                                <td><input class="form-check-input" type="checkbox" value=""
                                        id="flexCheckDefault">
                                </td>
                                <td>{{ $user_invitee_reminder->name }}</td>
                                <td>{{ $user_invitee_reminder->email }}</td>
                                <td>{{ $statuses[$user_invitee_reminder->status] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <button type="button" class="btn-login" style="border: none;">ارسال</button>
            </div>
        </div>
    </div>
</div>
