<!DOCTYPE html>
<html lang="en" dir="ltr">
@include('front.layouts.head')

<body>
    @include('front.layouts.my_nav')

    <div class="section pt-5 pb-5">
        <div class="container">
            <div class="d-flex justify-content-between">
                <h3 class="mb-5">جهات الاتصال</h3>
            </div>
            <div class="row">
                <div class="col-lg-4 co-md-6 col-12 d-flex justify-content-center">
                    <button type="button" class="btn-add-guest" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        اضافة جهة الاتصال
                    </button>
                </div>
                <div class="col-lg-4 co-md-6 col-12 d-flex justify-content-center">
                    <button type="button" class="btn-add-guest" data-bs-toggle="modal" data-bs-target="#exampleModal1">
                        استيراد
                    </button>
                </div>
                <div class="col-lg-4 co-md-6 col-12 d-flex justify-content-center">
                    <button type="button" class="btn-add-guest">
                        اضافة جميع جهات الاتصال
                    </button>
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


    <!-- Modal add contact -->
    @include('front.add_guest.components.add_contact')

    <!-- Modal-->
    @include('front.add_guest.components.contact_export')

    @include('front.layouts.scripts')

</body>

</html>
