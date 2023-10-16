@extends('Admin/layouts/master')

@section('title')
    الاعدادات
@endsection
@section('page_name')
    الاعدادات
@endsection
@section('content')
    <form method="POST" id="updateForm" class="updateForm" enctype="multipart/form-data"
        action="{{ route('settings.update', $settings->id) }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $settings->id }}">
        <div class="row mt-4">
            <div class="col-12">
                <div class="card" style="padding: 13px">
                    <div class="card-header">
                        <h3 class="card-title">قائمة الاعدادات </h3>
                    </div>
                    <!-- Start Row -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="form-control-label">لوجو</label>
                                <input type="file" class="dropify" name="logo"
                                    data-default-file="{{ asset($settings->logo) }}"
                                    accept="image/png,image/webp , image/gif, image/jpeg,image/jpg" />
                                <span class="form-text text-danger text-center">مسموح فقط بالصيغ التالية : png, gif, jpeg,
                                    jpg,webp</span>
                            </div>
                        </div>
                    </div>
                    <h1 class="card-title">قائمة الاعدادات العامة : </h1>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook_link">العنوان :</label>
                                <input type="text" name="title" value="{{ $settings->title }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">هاتف :</label>
                                <input type="text" name="phone" value="{{ $settings->phone }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="facebook_link">الايميل :</label>
                                <input type="text" name="email" value="{{ $settings->email }}" class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="phone">مكان :</label>
                                <input type="text" name="address" value="{{ $settings->address }}" class="form-control" />
                            </div>
                        </div>
                    </div>
                    <h1 class="card-title" style="font: bold">قائمة السوشيال ميديا : </h1>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="facebook_link">فيسبوك :</label>
                                <input type="text" name="facebook" value="{{ $settings->facebook }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">يوتيوب :</label>
                                <input type="url" name="youtube" value="{{ $settings->youtube }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">تويتر :</label>
                                <input type="url" name="twitter" value="{{ $settings->twitter }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">انستجرام :</label>
                                <input type="url" name="instagram" value="{{ $settings->instagram }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">لينكد ان :</label>
                                <input type="url" name="linkedin" value="{{ $settings->linkedin }}"
                                    class="form-control" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">واتساب :</label>
                                <input type="url" name="whatsapp" value="{{ $settings->whatsapp }}"
                                    class="form-control" />
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="desc_ar">شروط :</label>
                                <textarea name="terms" rows="8" class="form-control">{{ $settings->terms }}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="desc_en">خصوصية :</label>
                                <textarea name="privacy" rows="8" class="form-control">{{ $settings->privacy }}</textarea>
                            </div>
                        </div>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary" id="updateButton">تحديث</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @include('Admin/layouts/myAjaxHelper')
@endsection
@section('ajaxCalls')
    <script>
        editScript();
    </script>
@endsection
