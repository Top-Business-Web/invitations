<?php

namespace App\Http\Controllers\Front;

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

    public function newPassword()
    {
        return view('front.sign.new_password.new-password');
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
        return view('front.add_invite.add_invite');
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
