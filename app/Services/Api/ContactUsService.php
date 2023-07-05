<?php

namespace App\Services\Api;

use App\Models\ContactUs;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ContactUsService
{
    public function store($request){
        try {
            $rules = [
                'name' => 'required|min:2|max:191',
                'phone' => 'required|min:2|max:191',
                'subject' => 'nullable',
                'message' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return helperJson(null, $validator->errors(), 422);
            }
            $inputs = $request->all();
            $contact = ContactUs::create($inputs);
            return helperJson($contact, 'Sent Successfully',  Response::HTTP_OK);
        }catch(Exception $e){
            return helperJson(null, 'Sent Failed ',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
