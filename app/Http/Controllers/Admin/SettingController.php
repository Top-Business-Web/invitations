<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSetting;
use App\Models\Setting;
use App\Traits\PhotoTrait;


class SettingController extends Controller
{

    use PhotoTrait;
    public function index()
    {
        $settings = Setting::first();
        return view('Admin.settings.index', compact('settings'));
    }

    public function update(StoreSetting $request)
    {
        $settings = Setting::findOrFail($request->id);

        $inputs = $request->all();

        if ($request->has('logo'))
        {
            if (file_exists(public_path('assets/uploads/admins/setting/logo') .$settings->logo)) {
                unlink(('assets/uploads/admins/setting/logo') .$settings->logo);
            }
            $inputs['logo'] =  $request->logo != null ? $this->saveImage($request->logo, 'assets/uploads/admins/setting/logo' , 'photo') : $inputs['logo'];
        }

        if ($settings->update($inputs))
            return response()->json(['status' => 200]);
        else
            return response()->json(['status' => 405]);
    }
} // end class
