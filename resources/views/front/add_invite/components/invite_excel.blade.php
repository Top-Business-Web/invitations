<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="p-2">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="mb-3">استيراد جهات الاتصال من ملف اكسيل</h5>
                    <p>1- احفظ الملف على صيغة اكسيل</p>
                    <p>2- نسق بيانات الاتصال على هذا الشكل</p>
                    <div class="scroll">
                        <table class="table table-striped border">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">الاسم</th>
                                    <th scope="col">البريد الالكترونى</th>
                                    <th scope="col">الهاتف</th>
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
                    <form action="{{route('contacts.import')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label class="form-label">ملف جهات الاتصال </label>
                            <input type="file" name="file" class="form-control" required>
                        </div>
                        <div class="d-flex justify-content-center mb-2 mt-4">
                            <button class="btn-login" type="submit" style="border: none;">رفع الملف</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
