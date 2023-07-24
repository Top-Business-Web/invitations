<?php


namespace App\Services\Api;


use App\Http\Resources\InvitationResource;
use App\Models\Contact;
use App\Models\Invitation;
use App\Models\Invitee;
use App\Models\Message;
use App\Models\Scanned;
use App\Traits\PhotoTrait;
use Symfony\Component\HttpFoundation\Response;

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
                $inputs['image'] = $this->saveImage($request->image, 'assets/uploads/users', 'image', '100');
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
            return helperJson($invitation, 'Sent Successfully',  Response::HTTP_OK);
        }catch(Exception $e){
            return helperJson(null, 'Sent Failed ',  Response::HTTP_INTERNAL_SERVER_ERROR);
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
}
