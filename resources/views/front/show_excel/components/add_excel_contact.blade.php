<div class="section pt-5 pb-5">
    <div class="container">
        <div class="bg-white p-5 mb-3">
            <h5 class="mb-3">{{ __('site.import_contacts_from_excel_file') }}</h5>
            <p>1- {{ __('site.save_the_file_in_excel_format') }}</p>
            <p>2- {{ __('site.format_contact_information_in_this_format') }}</p>
            <div class="scroll">
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('site.the_name') }}</th>
                            <th scope="col">{{ __('site.email') }}</th>
                            <th scope="col">{{ __('site.phone') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">1</td>
                            <td>AYA</td>
                            <td>-</td>
                            <td>01050489206</td>
                        </tr>
                        <tr>
                            <td scope="row">2</td>
                            <td>AYA</td>
                            <td>aya@gmail.com</td>
                            <td>01050489206</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mb-2 mt-4">
                <button class="btn-login" style="border: none;" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                    {{ __('site.file_upload') }}
                </button>
{{--                <button class="btn-login" type="submit" style="border: none;" >رفع الملف</button>--}}
            </div>

        </div>

        <a href="{{ route('contact.index') }}" class="text-decoration-none main-btn1" style="width: 190px;">{{ __('site.back'). " ". __('site.contacts') }}</a>

    </div>
</div>

<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="p-2">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('contacts.import')}}" method="post" enctype="multipart/form-data">
                  @csrf
                    <div class="col-12">
                        <label class="form-label">ملف جهات الاتصال </label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                <div class="d-flex justify-content-center mb-2 mt-5">
                    <button class="btn-login" type="submit" style="border: none;"> حفظ</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

