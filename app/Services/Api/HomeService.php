<?php

namespace App\Services\Api;

use App\Http\Resources\Client\ProvidersResource;
use App\Http\Resources\InvitationResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SliderResource;;
use App\Models\Contact;
use App\Models\Invitation;
use App\Models\Notification;
use App\Models\User;
use App\Traits\DefaultImage;
use App\Traits\GeneralTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class HomeService
{
    use DefaultImage,GeneralTrait;

    public function index(){

        $search_key = request()->search_key;

        $invitations = Invitation::where(['user_id'=> Auth::guard('api')->id()])
            ->when($search_key,function ($query) use ($search_key) {
            $query->where('title', 'LIKE', '%' . $search_key .'%');
        })->get();


        return helperJson(InvitationResource::collection($invitations), '',200);
    }

    public function contacts(){
        $data = Contact::select('id','name','phone','email','user_id')->where('user_id', Auth()->id())->get();
        return helperJson($data, '');
    }


    public function notifications(){

        $data = NotificationResource::collection(Notification::query()->where('user_id','=',auth('user-api')->id())->get());
        return helperJson($data, '');
    }

    public function search($request){
        $search_key = $request->search_key;
//        dd($request->provider_id);
        $providers = User::when($request->provider_type,function ($query) use($request){
            return $query->where('provider_type',$request->provider_type);
        })->when($request->translation_type_id,function ($query) use($request){
            return $query->where('translation_type_id',$request->translation_type_id);
        })->when($request->city_id,function ($query) use($request){
            return $query->where('city_id',$request->city_id);
        })->when($request->search_key,function ($query) use($request){
            return $query->where('name','like',"%".$request->search_key."%");
        })->when($request->person_type,function ($query) use($request){
            return $query->where('person_type',$request->person_type);
        })->where('role_id',1)->get();
        return helperJson(ProvidersResource::collection($providers), '',200);
    }



}
