<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Models\Invitation;
use App\Models\Invitee;
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
            $image = $request->image;
            if($request->has('image')){
                $image = $request->file('image');
                $image = $this->saveImage($image,'assets/uploads/invitations','photo');
            }

            $addInvitation = Invitation::create([
                'date' => Carbon::parse($request->datePicker)->format('Y-m-d'),
                'title' => $request->title,
                'image' => $image,
                'has_qrcode' => $request->has_qrcode != null ? 1 : 0,
                'qrcode' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                'send_date' => 1,
                'address' => $request->address,
                'longitude' => $request->longitude,
                'latitude' => $request->latitude,
                'password' => mt_rand(11111111, 99999999),
                'user_id' => Auth::id(),
            ]);


            if ($addInvitation) {

                for ($i = 0; $i < count($request->contactArray); $i++) {
                    $invitee = Invitee::create([
						'invitation_id' => $addInvitation->id,
						'name'  => $request->contactArray[$i]['email'],
						'email'  => $request->contactArray[$i]['email'],
						'phone'  => $request->contactArray[$i]['phone'],
						'invitees_number'  => $request->contactArray[$i]['number'],
                    ]);
                }
            }

            if ($invitee) {

                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 405]);
            }

        } catch (\Exception $exception) {

            return response()->json(['error' => $exception->getMessage(), 'code' => 500]);
        }
    } // end add invitation

    public function InvitationStepTwo(Request $request, $id)
    {
        $invitation = Invitation::findOrFail($id);
        return view('front.add_invite.components.invite_excel', compact('invitation'));

    } // end InvitationStepTwo

    public function addInvitationStepTwo(Request $request)
    {

    }


}
