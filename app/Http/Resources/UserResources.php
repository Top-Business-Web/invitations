<?php

namespace App\Http\Resources;

use App\Models\Cities;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResources extends JsonResource
{

    /*
     User model resource
     */
    public function toArray($request)
    {
        return [
            'user'=> [
                'id'=>$this->id,
                'name'=>$this->name,
                'phone'=>$this->phone,
                'email'=>$this->email,
                'status'=>$this->status,
                'user_type'=>$this->role_id,
                'watts'=> $this->phone_code.$this->phone,
                'image'=>$this->image,
                'address'=>$this->address,
                'about_me'=>$this->about_me,
                'balance'=>$this->points,
                'city'=> @$this->city->{"name_".accept_language()},
            ],
            'access_token'=>'Bearer '.$this->token ??'',
            'token_type'=>'bearer'
        ];
    }
}
