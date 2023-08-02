<?php

namespace App\Http\Controllers\Api\ResetPassword;

use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller{

    public function __invoke(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required|exists:reset_code_passwords,phone'
        ]);


        // find the code
        $passwordReset = ResetCodePassword::firstWhere('phone','=',$request->phone);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => trans('passwords.code_is_expire')], 422);
        }

        // find user's email
        $user = User::query()->where('phone',$passwordReset->phone)->first();

        // update user password
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        // delete current code
        $passwordReset->delete();

        return response(['message' =>'password has been successfully reset','code'=>200], 200);
    }
}
