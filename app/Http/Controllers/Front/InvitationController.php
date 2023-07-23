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
    public function addInvitationByClient(StoreInvitationRequest $request)
    {
        try {

//            return $request->all();
//            if ($image = $request->file('image')) {
//                $destinationPath = 'assets/uploads/invitations';
//                $imagePath = date('YmdHis') . "." . $image->getClientOriginalExtension();
//                $image->move($destinationPath, $imagePath);
//                $request['image'] = "$imagePath";
//            }

            /*

              $image = $request->file('image');

            // Generate a unique name for the file
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Save the file to the public disk
            $image->storeAs('public/assets/uploads/invitations', $filename);
             */

//           $addInvitation = Invitation::create([
//               'date' => Carbon::parse($request->date)->format('Y-m-d'),
//               'title' => $request->title,
//               'image' => $imagePath,
//               'has_qrcode' => $request->has_qrcode != null ? 1 : 0,
//               'qrcode' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
//               'address' => $request->address,
//               'longitude' => $request->longitude,
//               'latitude' => $request->latitude,
//               'password' => mt_rand(11111111,99999999),
//               'user_id' => Auth::id(),
//           ]);



            $image = $request->file('image');
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('assets/uploads/invitations', $filename);
            $path = 'assets/uploads/invitations/' . $filename;

            $addInvitation = new Invitation();
            $addInvitation->date = Carbon::parse($request->date)->format('Y-m-d');
            $addInvitation->title = $request->title;
            $addInvitation->image =  $path;
            $addInvitation->has_qrcode = $request->has_qrcode != null ? 1 : 0;
            $addInvitation->qrcode = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $addInvitation->address = $request->address;
            $addInvitation->longitude = $request->longitude;
            $addInvitation->latitude = $request->latitude;
            $addInvitation->password = mt_rand(11111111,99999999);
            $addInvitation->user_id = Auth::id();
            $addInvitation->save();

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
