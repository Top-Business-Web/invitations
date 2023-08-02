<?php

namespace App\Http\Controllers\Front;

use App\Models\Contact;
use App\Models\ResetCodePassword;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.index.index');
    }

    public function notfound()
    {
        return view('front.not_found.not_found');
    }

    public function signIn()
    {
        if (Auth::check()) {
            return redirect('/invites');
        }
        return view('front.sign.sign_in.sign-in');
    }

    public function signUp()
    {
        if (Auth::check()) {
            return redirect('/invites');
        }
        return view('front.sign.sign_up.sign-up');
    }

    public function newPassword($code,$phone, $token)
    {
        $user = User::query()
            ->where('phone', 'like', '%' . $phone . '%')
            ->first();
        if ($user){
            $resetPassword = ResetCodePassword::query()
                ->where('phone', $phone)
                ->where('code', $code)
                ->latest()->first();

            if (!$resetPassword) {
                return view('front.sign.new_password.new-password', compact('phone', 'code'));
            } else {
                $msg = 'هذه الصفحة غير متاحة حاليا ';
                return view('front.500.500',compact('msg'));
            }
        } else {
            $msg = 'هذا المستخدم غير موجود في البيانات ';
            return view('front.500.500',compact('msg'));
        }

        // http://localhost:8000/en/new_password/245749/+201062933188/AMf-vBzRYHnQlhntCFtqKupCTILJiW6Cd7RuzfVJRk_wbGWZzDo75EVRcIdYv-PcbzkgG1ePMGzJUYEhxYBP0B7Fas41ot-sL70LVZVkl0ZQtoMeanzSmDWWLfG5uhMFnjvmh24HCOOIyRXGac5EaquLGy9LbGPiei-U8En0w4N_MmzphmmqA-l3trRnEsIlUVKBmYJTsJXZ


    }

    public function forgetPassword()
    {
        return view('front.sign.forget_password.forget-password');
    }

    public function verification()
    {
        return view('front.sign.verification.verification');
    }

    public function showInvites()
    {
        return view('front.invites.invite');
    }

    public function addInvites()
    {
        $contacts = Contact::where('user_id', Auth::user()->id)->get();
        return view('front.add_invite.add_invite', compact('contacts'));
    }

    public function addGuest()
    {

        return view('front.add_guest.add-guest');
    }


    public function scans()
    {
        return view('front.scans.scan');
    }
}
