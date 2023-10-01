<?php

namespace App\Services\Api;

use App\Http\Resources\InvitationResource;
use App\Models\Contact;
use App\Models\Invitation;
use App\Models\Invitee;
use App\Models\Message;
use App\Models\Scanned;
use App\Traits\PhotoTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;
use Twilio\Rest\Client;

class InvitationService
{
    use PhotoTrait;

    public function index()
    {
        $providers = User::where(['role_id' => 1])->get();
        return helperJson(ProvidersResource::collection($providers), '', 200);
    }

    public function store($request)
    {
        try {
            $inputs = $request->all();
            $inputs['user_id'] = auth()->id();
            $inputs['status'] = ($inputs['as_draft']) ? 0 : 1;
            $inputs['password'] = mt_rand(11111111, 99999999);
            $inputs['qrcode'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $inputs['lang'] = $request->lang;
            if ($request->has('image') && $request->image != null) {
                $inputs['image'] = $this->saveImage($request->image, 'assets/uploads/users', 'dddd', '100');
            }
            $invitation = Invitation::create($inputs);
            if ($request->step > 1) {
                foreach ($inputs['invitees'] as $invitee) {
                    if (Contact::where(['phone' => $invitee['phone'], 'user_id' => Auth()->id()])->count() < 1) {
                        Contact::create(
                            [
                                'user_id' => Auth()->id(),
                                'name' => $invitee['name'],
                                'phone' => $invitee['phone'],
                            ]
                        );
                    }
                    Invitee::create(
                        [
                            'invitation_id' => $invitation->id,
                            'name' => $invitee['name'],
                            'phone' => $invitee['phone'],
                            'invitees_number' => $invitee['invitees_number'] ?? 1,
                            'status' => 1,
                        ]
                    );
                }
            }
            if ($request->step > 2) {
                $invitees = Invitee::where(['invitation_id' => $invitation->id]);
                foreach ($invitees as $invitee) {
                    Invitee::where(['phone' => $invitee->phone, 'invitation_id' => $invitation->id])->update(
                        [
                            'invitees_number' => $invitee['invitees_number'] ?? 1,
                        ]
                    );
                }
            }
            $one_invitation = Invitation::find($invitation->id);

            if ($request->step > 3) {
                $one_invitation->lang = $request->lang;
                $one_invitation->save();
            }
            if ($request->step > 4) {
                $sendInviteByWhatsapp = $this->sendInviteByWhatsapp($inputs['invitees'], $one_invitation);
                foreach ($inputs['invitees'] as $key => $invitee) {
                    $sendInviteByWhatsapp[$key]['phone'] = $invitee['phone'];
                }
                $invitation ['send_log'] = $sendInviteByWhatsapp;
                $one_invitation->status = "1";

                $one_invitation->save();
            }
            return helperJson($invitation, 'Sent Successfully', Response::HTTP_OK);
        } catch (Exception $e) {
            return helperJson(null, 'Sent Failed ', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function replywats($request)
    {
        $one_invitation = Invitation::find(1);
        $invitees = ['phone' => '01003210436', 'name' => "ddddd"];
//        if($request->body == "yes"){
        $this->sendInviteByWhatsapp($invitees, $one_invitation);
//        }
    }

    /**
     * @param $contactArray
     * @param $one_invitation
     * @return array|void
     * @note 1 => primary template ,
     * 2 => send qrcode ,
     * 3 => send location ,
     * 4 => send reminder ,
     * 5 => send reject
     *
     */
    public function sendInviteByWhatsapp($contactArray, $one_invitation)
    {
        // declare params
        $phones = [];
        foreach ($contactArray as $value) {
            $phones [] = $value['phone'];
        }
        $title = $one_invitation->title;
        $invition_id = $one_invitation->id;
        $address = $one_invitation->address;
        $image = asset($one_invitation->image);

        // Send Template
        $response_data = [];

        if (count($phones) > 0) {

            for ($p = 0; $p < count($phones); $p++) {
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://go-wloop.net/api/v1/button/image/template',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_CAINFO => storage_path('cacert.pem'),
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => array(
                        'phone' => $phones[$p],
                        'image' => $image,
                        'caption' => $title,
                        'footer' => $address,
                        'buttons[0][id]' => '1',
                        'buttons[0][title]' => 'تاكيد',
                        'buttons[0][type]' => '1',
                        'buttons[0][extra_data]' => route('parcode', [$invition_id, $phones[$p]]),
                        'buttons[1][id]' => '2',
                        'buttons[1][title]' => 'اعتذار',
                        'buttons[1][type]' => '1',
                        'buttons[1][extra_data]' => route('sendReject', [$invition_id, $phones[$p]]),
                        'buttons[2][id]' => '3',
                        'buttons[2][title]' => 'موقع المناسبة',
                        'buttons[2][type]' => '1',
                        'buttons[2][extra_data]' => route('sendLocation', [$invition_id, $phones[$p]])
                    ),
                    CURLOPT_HTTPHEADER => array(
                        'Authorization: Bearer 503a35883a5b88104e46d1d7bed974fb_x1TqrHkFvBnS9d3NajSDrysId2WE5AWLSwrzjylZ',
                        'Cookie: oats_loob_go_session=vAdw9SL9IfN7twvtXnTjj0XdkVWiazxNlHbAZBZg',
                    ),
                ));
                $response = curl_exec($curl);
                curl_close($curl);
                $response_data [] = json_decode($response, true);

                DB::table('message_log')
                    ->insert([
                        'type' => 1,
                        'invitation_id' => $invition_id,
                        'phone' => $phones[$p],
                        'status' => $response_data[$p]['success'],
                    ]);

            }

            return $response_data;
        }


    }


    public function update($request, $id)
    {
        try {
            $inputs = $request->all();
            $invitation = Invitation::find($id);

            if ($request->has('image') && $request->image != null) {
                $inputs['image'] = $this->saveImage($request->image, 'assets/uploads/users', 'image', '100');
            }
            $invitation_updated = $invitation->update($inputs);
            if ($request->step > 1) {
                Invitee::where(['invitation_id' => $id])->delete();
                foreach ($inputs['invitees'] as $invitee) {
                    Invitee::create(
                        [
                            'invitation_id' => $invitation->id,
                            'name' => $invitee['name'],
                            'phone' => $invitee['phone'],
                            'invitees_number' => $invitee['invitees_number'] ?? 1,
                            'status' => 1,
                        ]
                    );
                }
            }
            if ($request->step > 2) {
                $invitees = Invitee::where(['invitation_id' => $invitation->id]);
                foreach ($invitees as $invitee) {
                    Invitee::where(['phone' => $invitee->phone, 'invitation_id' => $invitation->id])->update(
                        [
                            'invitees_number' => $invitee['invitees_number'] ?? 1,
                        ]
                    );
                }
            }
            return helperJson($invitation, 'Sent Successfully', Response::HTTP_OK);
        } catch (Exception $e) {
            return helperJson(null, 'Sent Failed ', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            Invitee::where(['invitation_id' => $id])->delete();

            $invitation = Invitation::find($id);
            if (!$invitation) {
                return helperJson([], 'invitation not found', 402);
            }
            $invitation->delete();


            return helperJson([], 'deleted Successfully', Response::HTTP_OK);
        } catch (Exception $e) {
            return helperJson(null, 'Sent Failed ', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function allInvitees($id)
    {

        $invitees = Invitee::where(['invitation_id' => $id])->get();
        return helperJson($invitees, '', 200);
    }

    public function scannedInvitees($id)
    {

        $scanned = Scanned::where(['invitation_id' => $id])->pluck('invitee_id');
        $invitees = Scanned::where(['invitation_id' => $id])->whereIn('invitee_id', $scanned)->get();
        return helperJson($invitees, '', 200);
    }


    public function messages($id)
    {
        $invitees = Invitee::where(['invitation_id' => $id])->get();

        $messages = $invitees->map(function ($item) use ($id) {
            $item->messages = Message::where(['invitation_id' => $id, 'invitee_id' => $item->id])->get();

            return $item;
        });

        return helperJson($messages, '', 200);
    }

    public function sendReminder($request)
    {
        try {
            $inputs = $request->all();

//                $invitees =  Invitee::where(['invitation_id'=>$inputs->invitation_id]);
            foreach ($inputs['invitees'] as $invitee) {
                //add code for watts app logic to send message
            }

            return helperJson('', 'Sent Successfully', Response::HTTP_OK);
        } catch (Exception $e) {
            return helperJson(null, 'Sent Failed ', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addInvitees($request)
    {
        try {
            $inputs = $request->all();


            $invitation = Invitation::find($inputs['invitation_id']);

            foreach ($inputs['invitees'] as $invitee) {
                if (Contact::where(['phone' => $invitee['phone'], 'user_id' => Auth()->id()])->count() < 1) {
                    Contact::create(
                        [
                            'user_id' => Auth()->id(),
                            'name' => $invitee['name'],
                            'phone' => $invitee['phone'],
                        ]
                    );
                }

                Invitee::create(
                    [
                        'invitation_id' => $invitation->id,
                        'name' => $invitee['name'],
                        'phone' => $invitee['phone'],
                        'invitees_number' => $invitee['invitees_number'] ?? 1,
                        'status' => 1,
                    ]
                );
            }

            return helperJson(new InvitationResource($invitation), 'Sent Successfully', Response::HTTP_OK);
        } catch (Exception $e) {
            return helperJson(null, 'Sent Failed ', Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
