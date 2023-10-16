<?php

namespace App\Http\Controllers\Auth;

use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PasswordResetController extends Controller
{
    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }

    // Implement the route to handle the form submission (not sending reset link here)
    public function reset(Request $request)
    {
//        dd($request->all());
        User::query()
            ->where('phone', 'like', '%' . $request->phone . '%')
            ->first()
            ->update([
                'password' => Hash::make($request->password)
            ]);
        ResetCodePassword::query()
            ->updateOrCreate(['phone' => $request->phone],
                [
                    'phone' => $request->phone,
                    'code' => $request->code
                ]);

        $msg = 'تم تغير كلمة السر بنجاح';
        return view('front.500.500',compact('msg'));
    }
}
