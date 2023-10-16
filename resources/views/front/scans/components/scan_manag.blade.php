<div class="section pt-5 pb-5">
    <div class="container">
        <div class="pt-5 pb-5 ps-3 pe-3 bg-white">
            <h3 class="mb-5">{{ __('site.scan_management') }}</h3>
            <div class="row mt-5">
                <div class="col-lg-4 col-md-5 col-sm-6 col-12 mb-2">
                    <input class="form-control" type="search" placeholder="{{ __('site.search') }}">
                </div>
            </div>
            <div class="scroll">
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('site.the_name') }}</th>
                            <th scope="col">{{ __('site.phone') }}</th>
                            <th scope="col">{{ __('site.scanned_quantity') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($scannedUsers->isEmpty())
                            <tr>
                                <td colspan="5" class="text-center">{{ __('site.there_is_no_information') }}
                                </td>
                            </tr>
                        @else
                            @foreach ($scannedUsers as $scannedUser)
                                <tr>
                                    <td scope="row">{{ $loop->iteration }}</td>
                                    <td>{{ $scannedUser->invitee->name }}</td>
                                    <td>{{ $scannedUser->invitee->phone }}</td>
                                    <td>{{ $scannedUser->totalCount }}</td>
                                </tr>
                            @endforeach
                            @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
