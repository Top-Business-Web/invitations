<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Models\Invitation;
use App\Traits\PhotoTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{
    use PhotoTrait;
   //add invitations
    public function addInvitationByClient(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required',
            'title' => 'required',
            'image' => 'required',
            'sur_name' => 'required|in:mr/mis,honored',
            'address' => 'required',
            ]);

            $image = null;
            if($request->iimage){
                $image = $request->file('image');
                $image = $this->saveImage($image,'assets/uploads/invitations','photo');
            }

            $addInvitation = new Invitation();
            $addInvitation->date = Carbon::parse($request->date)->format('Y-m-d');
            $addInvitation->title = $request->title;
            $addInvitation->image =  $image;
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
