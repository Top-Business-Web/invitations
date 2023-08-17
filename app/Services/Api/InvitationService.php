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
use Symfony\Component\HttpFoundation\Response;
use Twilio\Rest\Client;

class InvitationService
{
    use PhotoTrait;

    public function index(){
        $providers = User::where(['role_id'=>1])->get();
        return helperJson(ProvidersResource::collection($providers), '',200);
    }

    public function store($request){
        try {
            $inputs = $request->all();
            $inputs['user_id'] = auth()->id();
            $inputs['status'] = ($inputs['as_draft']) ? 0 :1;
            $inputs['password'] = mt_rand(11111111,99999999);
            $inputs['qrcode'] = \Ramsey\Uuid\Uuid::uuid4()->toString();
            $inputs['lang'] = $request->lang;
            if ($request->has('image') && $request->image != null) {
                $inputs['image'] = $this->saveImage($request->image, 'assets/uploads/users', 'dddd', '100');
            }
            $invitation = Invitation::create($inputs);
            if($request->step > 1){
                foreach ($inputs['invitees'] as $invitee){
                    if(Contact::where(['phone'=>$invitee['phone'],'user_id'=>Auth()->id()])->count() < 1){
                        Contact::create(
                            [
                                'user_id'=> Auth()->id(),
                                'name'=>$invitee['name'],
                                'phone'=>$invitee['phone'],
                            ]
                        );
                    }
                    Invitee::create(
                            [
                            'invitation_id'=> $invitation->id,
                            'name'=>$invitee['name'],
                            'phone'=>$invitee['phone'],
                            'invitees_number'=> $invitee['invitees_number'] ?? 1,
                            'status' => 1,
                            ]
                        );
                }
            }
            if($request->step > 2){
               $invitees =  Invitee::where(['invitation_id'=>$invitation->id]);
                foreach ($invitees as $invitee){
                    Invitee::where(['phone' => $invitee->phone,'invitation_id' => $invitation->id])->update(
                        [
                            'invitees_number'=> $invitee['invitees_number'] ?? 1,
                        ]
                    );
                }
            }
            $one_invitation =  Invitation::find($invitation->id);

            if($request->step > 3){
                $one_invitation->lang = $request->lang;
                $one_invitation->save();
            }
            if($request->step > 4){
                $this->sendInviteByWhatsapp($inputs['invitees'],$one_invitation);
                $one_invitation->status = "1";

                $one_invitation->save();
            }
            return helperJson($invitation, 'Sent Successfully',  Response::HTTP_OK);
        }catch(Exception $e){
            return helperJson(null, 'Sent Failed ',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function replywats($request)
    {
        $one_invitation =  Invitation::find(1);
        $invitees = ['phone'=>'01003210436','name'=>"ddddd"];
        if($request->body == "yes"){
            $this->sendInviteByWhatsapp($invitees,$one_invitation);
        }
    }
    public function sendInviteByWhatsapp_abdo( $contactArray)
    {

        $phones = [];
        if($contactArray){
            for ($contact = 0; $contact < count($contactArray); $contact++) {
                $contact = $contactArray[$contact]['phone'];

                $data = [
                    'appkey' => 'c0fd2111-1c65-41f5-90c1-794ffa752a6e',
                    'authkey' => 'Ac3TcLaOIbRpvaZD0qdcPKGuxD3GjSZY35TAGVI4KuHdgiPvfF',
                    'to' => $contact,
                    'template_id' => '43b7b891-4e3c-4c93-bb28-714479525c81',

                ];

                $curl = curl_init();

                $headers = [
                    'Content-Type: application/x-www-form-urlencoded', // Adjust based on API requirements
                ];

                curl_setopt_array($curl, [
                    CURLOPT_URL => 'https://wasender.amcoders.com/api/create-message',
                    CURLOPT_CAINFO => storage_path('cacert.pem'), //in local only
                    CURLOPT_HTTPHEADER => $headers,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS => http_build_query($data),

                ]);

                $response = curl_exec($curl);
                if ($response === false) {
                    $error = curl_error($curl);
                    $errorNumber = curl_errno($curl);
                    dd("cURL Error: {$error} (Error Code: {$errorNumber})");
                }

                curl_close($curl);

                dd($response);

            }
        }


    }

  public function sendInviteByWhatsapp( $contactArray,$one_invitation)
    {

        $phones = [];
        if($contactArray){
            for ($contact = 0; $contact < count($contactArray); $contact++) {
                $phone = $contactArray[$contact]['phone'];

                $phoneNumber = "+2".$phone;
                $message = 'المكرم: '.$contactArray[$contact]['name'].'  نتشرف بدعوتكم لحضور '.$one_invitation->title." بتاريخ ".$one_invitation->date;

                $accountSid = 'ACd06621e52f6b8aec6e4e31607ccf1c56';
                $authToken = '3680b3489b558f90e3663837e777fa42';
                $twilioPhoneNumber = '+14155238886';
//        $response = new MessagingResponse();
                $twilioClient = new Client($accountSid, $authToken);
                // Cart details
                $webpageUrl = "https://daawat.topbusiness.io/share/6/7/1";
                $twilioClient->messages->create(
                    "whatsapp:$phoneNumber",
                    [
                        'from' => "whatsapp:$twilioPhoneNumber",
                        "mediaUrl" => ["https://daawat.topbusiness.io/share/6/7/1"],
                        'body' => $message,
//                        'mediaUrl' => ["$webpageUrl"], // Optional: Include media (link)

//                        'Content-Type' => 'text/html'
                    ]
                );




            }
        }


    }


    public function update($request,$id){
        try {
            $inputs = $request->all();
            $invitation = Invitation::find($id);

            if ($request->has('image') && $request->image != null) {
                $inputs['image'] = $this->saveImage($request->image, 'assets/uploads/users', 'image', '100');
            }
            $invitation_updated = $invitation->update($inputs);
            if($request->step > 1){
                Invitee::where(['invitation_id'=>$id])->delete();
                foreach ($inputs['invitees'] as $invitee){
                    Invitee::create(
                        [
                            'invitation_id'=> $invitation->id,
                            'name'=>$invitee['name'],
                            'phone'=>$invitee['phone'],
                            'invitees_number'=> $invitee['invitees_number'] ?? 1,
                            'status' => 1,
                        ]
                    );
                }
            }
            if($request->step > 2){
                $invitees =  Invitee::where(['invitation_id'=>$invitation->id]);
                foreach ($invitees as $invitee){
                    Invitee::where(['phone' => $invitee->phone,'invitation_id' => $invitation->id])->update(
                        [
                            'invitees_number'=> $invitee['invitees_number'] ?? 1,
                        ]
                    );
                }
            }
            return helperJson($invitation, 'Sent Successfully',  Response::HTTP_OK);
        }catch(Exception $e){
            return helperJson(null, 'Sent Failed ',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id){
        try {
            Invitee::where(['invitation_id'=>$id])->delete();

            $invitation = Invitation::find($id);
            if(!$invitation){
                return helperJson([], 'invitation not found',  402);
            }
            $invitation->delete();


            return helperJson([], 'deleted Successfully',  Response::HTTP_OK);
        }catch(Exception $e){
            return helperJson(null, 'Sent Failed ',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function allInvitees($id){

        $invitees = Invitee::where(['invitation_id'=> $id])->get();
        return helperJson($invitees, '',200);
    }

    public function scannedInvitees($id){

        $scanned = Scanned::where(['invitation_id'=> $id])->pluck('invitee_id');
        $invitees = Scanned::where(['invitation_id'=> $id])->whereIn('invitee_id',$scanned)->get();
        return helperJson($invitees, '',200);
    }


    public function messages($id){
        $invitees = Invitee::where(['invitation_id'=> $id])->get();

        $messages = $invitees->map(function ($item) use ($id) {
            $item->messages = Message::where(['invitation_id'=> $id,'invitee_id' => $item->id])->get();

            return $item;
        });

        return helperJson($messages, '',200);
    }

    public function sendReminder($request){
        try {
                $inputs = $request->all();

//                $invitees =  Invitee::where(['invitation_id'=>$inputs->invitation_id]);
                foreach ($inputs['invitees'] as $invitee){
                  //add code for watts app logic to send message
                }

            return helperJson('', 'Sent Successfully',  Response::HTTP_OK);
        }catch(Exception $e){
            return helperJson(null, 'Sent Failed ',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function addInvitees($request){
        try {
            $inputs = $request->all();


            $invitation = Invitation::find($inputs['invitation_id']);

            foreach ($inputs['invitees'] as $invitee){
                if(Contact::where(['phone'=>$invitee['phone'],'user_id'=>Auth()->id()])->count() < 1){
                    Contact::create(
                        [
                            'user_id'=> Auth()->id(),
                            'name'=>$invitee['name'],
                            'phone'=>$invitee['phone'],
                        ]
                    );
                }

                Invitee::create(
                    [
                        'invitation_id'=> $invitation->id,
                        'name'=>$invitee['name'],
                        'phone'=>$invitee['phone'],
                        'invitees_number'=> $invitee['invitees_number'] ?? 1,
                        'status' => 1,
                    ]
                );
            }

            return helperJson(new InvitationResource($invitation), 'Sent Successfully',  Response::HTTP_OK);
        }catch(Exception $e){
            return helperJson(null, 'Sent Failed ',  Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


}
