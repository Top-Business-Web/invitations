<?php

namespace App\Services\Api;

use App\Http\Resources\{CompanyResource, UserResources};
use App\Models\FirebaseToken;
use App\Models\User;
use App\Services\Api\Request;
use App\Traits\DefaultImage;
use App\Traits\GeneralTrait;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use function auth;
use function collect;
use function helperJson;
use function request;
use function response;

class AuthService
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

        $loggedIn['password'] =  '123456';

        if (! $token = auth('user-api')->attempt($data)) {
            return helperJson(null, 'there is no user', 406);
        }
        $user = User::where('email',$data['email']);
        $user = $user->firstOrFail();
        $token = JWTAuth::fromUser($user);
        $user->token = $token;

        return helperJson(new UserResources($user), 'login successfully');
    }//end fun

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register($request)
    {
        $rules = [
            'phone_code' => 'nullable',
            'phone' => 'required|unique:users,phone',
            'name' => 'required|min:2|max:191',
            'email' => 'nullable|unique:users,email',
            'location' => 'nullable',
            'with_google' => 'nullable',
            'password' => 'required|min:6',
        ];
        $validator = Validator::make($request->all(), $rules, [
            'phone.unique' => 409,
            'email.unique' => 410,
        ]);
        if ($validator->fails()) {
            $errors = collect($validator->errors())->flatten(1)[0];
            if (is_numeric($errors)) {
                $errors_arr = [
                    409 => 'Failed,phone number already exists',
                    410 => 'Failed,email already exists',
                ];
                $code = (int)collect($validator->errors())->flatten(1)[0];
                return helperJson(null, isset($errors_arr[$errors]) ? $errors_arr[$errors] : 500, $code);
            }
            return helperJson(null, $validator->errors(), 422);
        }
        $data = $request->validate($rules);

        $data['image'] = '';
        if ($request->hasFile('image')) {
            $data['image'] = $this->uploadFiles('users', $request->file('image'));
        }

        if($data['with_google']){
            $data['password'] = Hash::make('dummypass123');
        }else{
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::create($data);


        if ($user) {
            if (!$token = JWTAuth::fromUser($user)) {
                return helperJson(null, 'there is no user', 430);
            }
        }
        $user->token = $token;

        return helperJson(new UserResources($user), 'register successfully');
    }//end fun

    public function update_profile($request){
        $user = auth()->user();
        $validator = Validator::make($request->all(), [
//            'phone'      => 'required|unique:users,phone,'.$user->id,
//            'password'   => 'nullable',
        ]);
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator,406);
        }

//        $validator = Validator::make($request->all(), [
//            'email' => 'required|email|unique:users,email,'.$user->id,
//        ]);
//        if ($validator->fails()) {
//            $code = $this->returnCodeAccordingToInput($validator);
//            return $this->returnValidationError($code, $validator,407);
//        }

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image',
        ]);
        if ($validator->fails()) {
            $code = $this->returnCodeAccordingToInput($validator);
            return $this->returnValidationError($code, $validator,400);
        }

        $data = $request->all();

        if($request->hasFile('image')){
            $data['image'] = $this->uploadFiles('users', $request->file('image'));
        }
        $user = User::find($user->id);
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->save();
        $token = JWTAuth::fromUser($user);
        $user->token = $token;

        return helperJson(new UserResources($user), 'Updated successfully');
    }//end fun

    public function delete_account($request)
    {
        $user = auth('user-api')->user();
        if(!isset($user)){
            return helperJson(null, 'This Account not found',404);
        }

        User::find($user->id)->delete();
        return helperJson(null, 'Account Deleted successfully',200);

    }//end fun


    public function insertToken($request)
    {
        $rules = [
            'phone_token' => 'required',
            'software_type' => 'required|in:android,ios,web'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $errors = collect($validator->errors())->flatten(1)[0];
            if (is_numeric($errors)) {
                $errors_arr = [
                    409 => 'Failed,phone number already exists',
                    410 => 'Failed,email already exists',
                ];
                $code = (int)collect($validator->errors())->flatten(1)[0];
                return helperJson(null, isset($errors_arr[$errors]) ? $errors_arr[$errors] : 500, $code);
            }
            return helperJson(null, $validator->errors(), 422);
        }
        $data = $request->validate($rules);

        $data['user_id'] = auth()->user()->id;

        $token = FirebaseToken::updateOrCreate($data);

        return helperJson($token, 'register successfully');
    }//end fun

    public function profile($request)
    {
        $user = auth()->user();

        $user['token'] = trim($request->headers->get('Authorization'), 'Bearer ');

       return helperJson(new UserResources($user), '');
    }
}
