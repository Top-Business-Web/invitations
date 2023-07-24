<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function getProfileUserData()
    {
        $profile = User::where('id', auth()->user()->id)->first();
        return view('front.profile.profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'phone' => 'required|string',
        ]);

        $userProfile = User::where('id', auth()->user()->id)->first();

        if (!$userProfile) {
            return response()->json(['status' => 405]);
        }

        $userProfile->update($validatedData);

        return response()->json(['status' => 200]);
    }
}
