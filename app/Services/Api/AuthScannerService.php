<?php


namespace App\Services\Api;


use App\Http\Resources\InvitationResource;
use App\Http\Resources\UserResources;
use App\Models\Invitation;
use App\Models\User;
use App\Traits\DefaultImage;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class AuthScannerService
{
    use DefaultImage,GeneralTrait;
    public function login($request)
    {
        $rules = [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules, [
            'email.exists' => 410,
        ]);
        if ($validator->fails()) {
            $errors = collect($validator->errors())->flatten(1)[0];
            if (is_numeric($errors)) {
                $errors_arr = [
                    410 => 'Failed,email not exists',
                ];
                $code = (int)collect($validator->errors())->flatten(1)[0];
                return helperJson(null, isset($errors_arr[$errors]) ? $errors_arr[$errors] : 500, $code);
            }
            return response()->json(['data' => null, 'message' => $validator->errors()->first(), 'code' => 422], 200);
        }
        $data = $request->validate($rules);
//        dd($data);
        $loggedIn['email'] = request('email');

        $loggedIn['password'] =  request('password');

//        if (! $token = auth('user-api')->attempt($data)) {
//            return helperJson(null, 'there is no user', 406);
//        }
        $user = User::where('email',$data['email']);
        $user = $user->firstOrFail();
        $token = JWTAuth::fromUser($user);
        $user->token = $token;
        $invitation = Invitation::where(['user_id'=> $user->id,'password'=>$data['password']])->first();
        if (! $invitation) {
            return helperJson(null, 'there is no invitation', 406);
        }
        return helperJson(['user-model' =>new UserResources($user),'invitation-model'=> new InvitationResource($invitation)], 'تم تسجيل الدخول بنجاح بواسطه البريد الالكتروني وكلمه مرور الدعوه بنجاح');
    }//end fun
}
