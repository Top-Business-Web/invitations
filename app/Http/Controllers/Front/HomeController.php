<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('front.index.index');
    }
    public function signIn()
    {
        return view('front.sign.sign_in.sign-in');
    }

    public function signUp()
    {
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

    public function contact()
    {
        return view('front.contacts.contact');
    }

    public function profile()
    {
        return view('front.profile.profile');
    }

    public function reminder()
    {
        return view('front.reminder.reminder');
    }

    public function showExcel()
    {
        return view('front.show_excel.show_excel');
    }

    public function scans()
    {
        return view('front.scans.scan');
    }
}
