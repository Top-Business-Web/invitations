<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvitationRequest;
use App\Models\Contact;
use App\Models\Invitation;
use App\Models\Invitee;
use App\Traits\PhotoTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

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

            $user = Auth::user();
            $invites_number = 0;
            $total_invites = 0;


            $array = explode(',', $request->check_contact);


            if ($addInvitation->save()) {
                for ($i = 0; $i < count($request->contactArray); $i++) {

                    if (in_array($request->contactArray[$i]['id'], $array)) {

                        Invitee::create([
                            'invitation_id' => $addInvitation->id,
                            'name' => $request->contactArray[$i]['name'],
                            'email' => $request->contactArray[$i]['email'],
                            'phone' => $request->contactArray[$i]['phone'],
                            'invitees_number' => $request->contactArray[$i]['number'],
                        ]);

                        $invites_number += $request->contactArray[$i]['number'];
                        ++$total_invites;
                    }
                }

                $total_invitations_count = $invites_number + $total_invites;

                if ($user->points >= $total_invitations_count) {

                    $user->update(['points' => $user->points - $total_invitations_count]);
                    return response()->json(['status' => 200]);

                } else {

                    DB::table('invitations')->where('id', '=', $addInvitation->id)->delete();
                    DB::table('invitees')->where('invitation_id', '=', $addInvitation->id)->delete();

                    return response()->json(['status' => 409]);
                }

            } else {
                return response()->json(['status' => 405]);
            }

        } catch (\Exception $exception) {

            return response()->json(['error' => $exception->getMessage(), 'code' => 500]);
        }
    } // end add invitation

    public function addDraft(Request $request)
    {
        try {
            $image = $request->image;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image = $this->saveImage($image, 'assets/uploads/invitations', 'photo');
            } else {
                $request->except('image');
            }

            if ($request->id == null) {
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
            } else {
                $addInvitation = Invitation::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'date' => Carbon::parse($request->datePicker)->format('Y-m-d'),
                        'title' => $request->title,
                        'image' => $image,
                        'has_qrcode' => $request->has_qrcode != null ? 1 : 0,
                        'qrcode' => \Ramsey\Uuid\Uuid::uuid4()->toString(),
                        'send_date' => 1,
                        'address' => $request->address,
                        'longitude' => $request->longitude,
                        'latitude' => $request->latitude,
                        'status' => $request->status,
                        'password' => mt_rand(11111111, 99999999),
                        'user_id' => Auth::id(),
                    ]
                );
                if ($addInvitation) {
                    return response()->json(['status' => 200]);
                } else {
                    return response()->json(['status' => 405]);
                }
            }


        } catch (\Exception $exception) {

            return response()->json(['error' => $exception->getMessage(), 'code' => 500]);
        }
    } // end add draft
    public function editInvitation($id)
    {
        $invite = Invitation::query()
            ->where('id', $id)
            ->with('invitees')
            ->first();

        $contacts = Contact::where('user_id', Auth::user()->id)->get();

        return view('front.add_invite.edit_invite', compact('invite', 'contacts'));
    }

    public function editInvitationByClient(Request $request)
    {
        $invite = Invitation::findOrFail($request->id);
        try {
            $image = $request->image;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image = $this->saveImage($image, 'assets/uploads/invitations', 'photo');
            } else {
                $request->except('image');
            }

            $invite->date = Carbon::parse($request->datePicker)->format('Y-m-d');
            $invite->title = $request->title;
            $invite->image = $image;
            $invite->has_qrcode = $request->has_qrcode != null ? 1 : 0;
            $invite->qrcode = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $invite->send_date = 1;
            $invite->address = $request->address;
            $invite->longitude = $request->longitude;
            $invite->latitude = $request->latitude;
            $invite->status = $request->status;
            $invite->password = mt_rand(11111111, 99999999);
            $invite->user_id = Auth::id();

            $invite->save();

            if ($invite->save()) {

                for ($i = 0; $i < count($request->contactArray); $i++) {

                    Invitee::updateOrCreate([
                        'invitation_id' => $invite->id,
                        'phone' => $request->contactArray[$i]['phone'],
                    ], [
                        'invitation_id' => $invite->id,
                        'name' => $request->contactArray[$i]['name'],
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
    } // end edit invitation

    public function changeStatus(Request $request)
    {
        $userId = $request->input('id');
        $token = Str::random(60);

        // Assuming you have a User model with a 'status' field
        $user = Invitee::find($userId);

        if ($user->status !== 3) {
            $user->status = 3;
            $user->save();
            return response()->json(['status' => 200]);
        } else if($user->status == 3) {
            return redirect()->route('parcode',[$userId,$token]);
        }
    } // end change status


    public function parcode($id,$cId,$token){
        $data['invitation'] = Invitation::find($id);
        $data['invitess'] = Invitee::find($cId);
        return view('front.parcode.parcode')->with($data);
    } // end parcode

}
