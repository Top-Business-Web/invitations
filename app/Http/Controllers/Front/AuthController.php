<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        if (Auth::guard('user')->check()) {
            return redirect('/index');
        }
        return view('front.sign.sign_in.sign-in');
    }


    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|min:11',
            'password' => 'required',
        ], [
            'name.required' => 'الاسم مطلوب',
            'phone.min' => 'الرقم يجب أن يكون على الأقل 11',
            'email.email' => 'يرجى إدخال بريد إلكتروني صحيح',
            'email.unique' => 'هذا البريد مسجل بالفعل',
            'email.required' => 'يرجى إدخال البريد الإلكتروني',
            'password.required' => 'يرجى إدخال كلمة المرور',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'points' => 1,
            'password' => bcrypt($data['password']),
        ]);

        if ($user) {
            Auth::guard('web')->login($user);
            return response()->json(200);
        }

        return response()->json(405);
    }


    public function login(Request $request): \Illuminate\Http\JsonResponse
    {
        $data = $request->validate([
            'email'   => 'required|exists:users',
            'password' => 'required'
        ], [
            'email.exists'      => 'هذا البريد غير مسجل معنا',
            'email.required'    => 'يرجي ادخال البريد الالكتروني',
            'password.required' => 'يرجي ادخال كلمة المرور',
        ]);
        if (Auth::guard('web')->attempt($data)) {
            return response()->json(200);
        }
        return response()->json(405);
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        toastr()->info('تم تسجيل الخروج');
        return redirect()->route('signIn');
    }
}
