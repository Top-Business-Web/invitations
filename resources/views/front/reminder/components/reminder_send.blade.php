<div class="section pt-5 pb-5">
    <div class="container">
        <div class="pt-5 pb-5 ps-3 pe-3 bg-white">
            <h3 class="mb-5">{{ __('site.call_reminder') }}</h3>
            <div class="scroll">
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('site.to_set') }}</th>
                            <th scope="col">{{ __('site.the_name') }}</th>
                            <th scope="col">{{ __('site.email') }}</th>
                            <th scope="col">{{ __('site.the_status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                    <input type="hidden" name="id" value="{{ $id }}">
                        @foreach ($users_invitees_reminder as $user_invitee_reminder)
                            <tr>
                                <td scope="row">{{ $user_invitee_reminder->id }}</td>
                                <td><input class="form-check-input userPhone"
                                           type="checkbox" value="{{ $user_invitee_reminder->phone }}">
                                </td>
                                <td>{{ $user_invitee_reminder->name }}</td>
                                <td>{{ $user_invitee_reminder->email }}</td>
                                <td>{{ app()->getLocale() === 'ar' ? $statusesAr[$user_invitee_reminder->status] : $statusesEn[$user_invitee_reminder->status] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                <button type="button" class="btn-login" id="reminderBtn" style="border: none;">{{ __('site.send') }}</button>
            </div>
        </div>
    </div>
</div>
