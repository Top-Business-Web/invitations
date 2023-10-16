<?php

namespace App\Http\Controllers\Front;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileUpdateRequest;

class ProfileController extends Controller
{
    public function getProfileUserData()
    {
        $profile = User::where('id', auth()->user()->id)->first();
        return view('front.profile.profile', compact('profile'));
    }

    public function update(ProfileUpdateRequest $request)
    {
        $validatedData = $request->validated();

        $userProfile = User::find(auth()->user()->id);

        if (!$userProfile) {
            return response()->json(['status' => 405]);
        }

        $userProfile->update($validatedData);

        return response()->json(['status' => 200]);
    } // end update
}
