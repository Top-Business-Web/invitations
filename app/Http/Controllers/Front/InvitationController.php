<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Models\Invitation;
use App\Traits\PhotoTrait;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class InvitationController extends Controller
{

    use PhotoTrait;

    //add invitations
    public function addInvitationByClient(StoreInvitationRequest $request)
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
                'password' => mt_rand(11111111, 99999999),
                'user_id' => Auth::id(),
            ]);

            if ($addInvitation->save()) {


                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 405]);
            }
        } catch (\Exception $exception) {

            return response()->json(['error' => $exception->getMessage(), 'code' => 500]);
        }
    }

    public function updateInvitationByClient(StoreInvitationRequest $request, $invitationId): JsonResponse
    {
        try {
            $invitation = Invitation::find($invitationId);

            if (!$invitation) {
                return response()->json(['status' => 404, 'message' => 'Invitation not found']);
            }

            // Your existing image upload logic here...

            $invitation->date = Carbon::parse($request->date)->format('Y-m-d');
            $invitation->title = $request->title;
            $invitation->sur_name = $request->sur_name;
            $invitation->address = $request->address;
            $invitation->longitude = $request->longitude;
            $invitation->latitude = $request->latitude;
            $invitation->user_id = Auth::id();

            // Update any other fields as needed

            if ($invitation->save()) {
                return response()->json(['status' => 200]);
            } else {
                return response()->json(['status' => 405]);
            }
        } catch (\Exception $exception) {
            return response()->json(['error' => $exception->getMessage(), 'code' => 500]);
        }
    }
}
