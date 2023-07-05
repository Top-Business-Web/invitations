<?php


namespace App\Services\Api;


class InvitationService
{

    public function index(){
        $providers = User::where(['role_id'=>1])->get();
        return helperJson(ProvidersResource::collection($providers), '',200);
    }

}
