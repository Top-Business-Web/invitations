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
            if ($request->has('image')) {
                $image = $request->file('image');
                $image = $this->saveImage($image, 'assets/uploads/invitations', 'photo');
            }

            $addInvitation = new Invitation();
            $addInvitation->date = Carbon::parse($request->datePicker)->format('Y-m-d');
            $addInvitation->title = $request->title;
            $addInvitation->image = $image;
            $addInvitation->has_qrcode = $request->has_qrcode != null ? 1 : 0;
            $addInvitation->qrcode = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $addInvitation->send_date = 1;
            $addInvitation->address = $request->address;
            $addInvitation->longitude = $request->longitude;
            $addInvitation->latitude = $request->latitude;
            $addInvitation->status = $request->status;
            $addInvitation->password = mt_rand(11111111, 99999999);
            $addInvitation->user_id = Auth::id();

            $addInvitation->save();

            if ($addInvitation->save()) {

                for ($i = 0; $i < count($request->contactArray); $i++) {
                    Invitee::create([
                        'invitation_id' => $addInvitation->id,
                        'name' => $request->contactArray[$i]['email'],
                        'email' => $request->contactArray[$i]['email'],
                        'phone' => $request->contactArray[$i]['phone'],
                        'invitees_number' => $request->contactArray[$i]['number'],
                    ]);
                }

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

    public function addDraft(Request $request)
    {
        try {
            $image = $request->image;
            if ($request->has('image')) {
                $image = $request->file('image');
                $image = $this->saveImage($image, 'assets/uploads/invitations', 'photo');
            }

            $addInvitation = new Invitation();
            $addInvitation->date = Carbon::parse($request->datePicker)->format('Y-m-d');
            $addInvitation->title = $request->title;
            $addInvitation->image = $image;
            $addInvitation->has_qrcode = $request->has_qrcode != null ? 1 : 0;
            $addInvitation->qrcode = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $addInvitation->send_date = 1;
            $addInvitation->address = $request->address;
            $addInvitation->longitude = $request->longitude;
            $addInvitation->latitude = $request->latitude;
            $addInvitation->status = $request->status;
            $addInvitation->password = mt_rand(11111111, 99999999);
            $addInvitation->user_id = Auth::id();

            $addInvitation->save();

            if ($addInvitation->save()) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 405]);
            }

        } catch (\Exception $exception) {

            return response()->json(['error' => $exception->getMessage(), 'code' => 500]);
        }
    } // end add draft


}
