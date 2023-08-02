<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PasswordResetController extends Controller
{
    public function showResetForm()
    {
        return view('auth.passwords.reset');
    }

    // Implement the route to handle the form submission (not sending reset link here)
    public function reset(Request $request)
    {
        // Process the form submission, but do not handle password reset link sending here
        // Password reset link sending will be handled on the frontend using Firebase SDK
        // You can validate the form data, etc., and perform necessary actions as required.
    }
}
