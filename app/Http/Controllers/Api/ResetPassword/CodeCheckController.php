<?php

namespace App\Http\Controllers\Api\ResetPassword;

use App\Http\Controllers\Controller;
use App\Models\ResetCodePassword;
use Illuminate\Http\Request;

class CodeCheckController extends Controller{

    public function __invoke(Request $request)
    {
        $request->validate([
            'code' => 'required|string|exists:reset_code_passwords',
        ]);

        // find the code
        $passwordReset = ResetCodePassword::firstWhere('code', $request->code);

        // check if it does not expired: the time is one hour
        if ($passwordReset->created_at > now()->addHour()) {
            $passwordReset->delete();
            return response(['message' => 'code is expire'], 422);
        }

        return response([
            'verify_code' => $passwordReset->code,
            'code' =>200,
            'message' => "Success code and now try to go the reset password page"
        ], 200);
    }

}
