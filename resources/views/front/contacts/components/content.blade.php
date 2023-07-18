<div class="section pt-5 pb-5">
    <div class="container">
        <div class="d-flex justify-content-between mb-4">
            <h3>جهات الاتصال</h3>
            <div class="d-flex flex-column">
                <button type="button" class="main-btn1 mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    اضافة جهة الاتصال
                </button>
                <a href="{{ route('contacts.showExcel') }}" class="text-decoration-none">
                    <button type="button" class="main-btn1 bg-color">استيراد</button>
                </a>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-4 col-md-5 col-sm-6 col-12 mb-2">
                <input class="form-control" type="search" placeholder="بحث">
            </div>
        </div>
        <div class="p-3 bg-white">
            <div class="scroll">
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">الاسم</th>
                            <th scope="col">البريد الالكترونى</th>
                            <th scope="col">الهاتف</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td scope="row">1</td>
                            <td>AYA</td>
                            <td>-</td>
                            <td>01050489206</td>
                            <td>
                                <div class="text-center">
                                    <button type="button" class="edit-table" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-pen-to-square fa-lg ms-2"></i>
                                    </button>
                                    <button type="button" class="edit-table delete-table">
                                        <i class="fa-solid fa-trash-can fa-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td scope="row">2</td>
                            <td>AYA</td>
                            <td>-</td>
                            <td>01050489206</td>
                            <td>
                                <div class="text-center">
                                    <button type="button" class="edit-table" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal">
                                        <i class="fa-solid fa-pen-to-square fa-lg ms-2"></i>
                                    </button>
                                    <button type="button" class="edit-table delete-table">
                                        <i class="fa-solid fa-trash-can fa-lg"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
