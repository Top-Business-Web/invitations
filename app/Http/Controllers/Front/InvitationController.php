<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Models\Invitation;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{

    //add invitations
    public function addInvitationByClient(StoreInvitationRequest $request): JsonResponse
    {
        try {

//            return $request->all();
            if ($image = $request->file('image')) {
                $destinationPath = 'assets/uploads/invitations';
                $imagePath = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imagePath);
                $request['image'] = "$imagePath";
            }

           $addInvitation = Invitation::create([
               'date' => Carbon::parse($request->date)->format('Y-m-d'),
               'title' => $request->title,
               'image' => $imagePath ?? null,
               'has_qrcode' => $request->has_qrcode != null ? 1 : 0,
               'qrcode' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
               'address' => $request->address,
               'longitude' => $request->longitude,
               'latitude' => $request->latitude,
               'password' => mt_rand(11111111,99999999),
               'user_id' => Auth::id(),
           ]);

            if($addInvitation->save()){

                return response()->json(['status' => 200]);
            }else{
                return response()->json(['status' => 405]);
            }

        }catch (\Exception $exception){

            return response()->json(['error' => $exception->getMessage(),'code' => 500]);
        }
    }



}