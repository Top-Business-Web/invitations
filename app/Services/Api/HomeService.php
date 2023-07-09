<?php

namespace App\Services\Api;

use App\Http\Resources\Client\ProvidersResource;
use App\Http\Resources\InvitationResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\SliderResource;;


use App\Models\Invitation;
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

        $invitations = Invitation::where(['user_id'=> auth()->id()])->when($search_key,function ($query) use ($search_key) {
            $query->where('title', 'LIKE', '%'.$search_key.'%');
        })->get();
        return helperJson(InvitationResource::collection($invitations), '',200);
    }

    public function categories(){
        $data = Category::select('id','name','image')->get();

        return helperJson($data, '');
    }


    public function services($category_id){

        $services = Service::where(['category_id'=>$category_id,'status'=> 1])->whereDate('expired_at', '>', Carbon::now())->with('provider')->get();
        $data = ServiceResource::collection($services);
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
