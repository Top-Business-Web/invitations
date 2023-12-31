<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleLoginController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                toastr()->success('تم تسجيل الدخول بواسطة Google');
                Auth::login($finduser);           
                return redirect()->intended('/invites');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' =>  Hash::make('dummypass123') // you can change auto generate password here and send it via email but you need to add checking that the user need to change the password for security reasons
                ]);

                Auth::login($newUser);

                return redirect()->intended('/invites');
            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
