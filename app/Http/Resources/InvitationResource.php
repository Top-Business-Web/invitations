<?php

namespace App\Http\Resources;

use App\Models\Invitee;
use App\Models\Message;
use Illuminate\Http\Resources\Json\JsonResource;

class InvitationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $id = $this->id;
        $invitees = Invitee::query()->whereHas('messages')->where(['invitation_id'=> $id])->get();
        $messages = $invitees->map(function ($item) use ($id) {
            $item->messages = Message::query()->where(['invitation_id'=> $id,'invitee_id' => $item->id])->get();
            return $item;
        });

        return [
            'id'=>$this->id,
            'date'=>$this->date,
            'title'=>$this->title,
            'image'=>$this->image,
            'has_qrcode'=>$this->has_qrcode,
            'qrcode'=>$this->qrcode,
            'send_date'=>$this->send_date,
            'address'=>$this->address,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
            'password'=>$this->password,
            'user_id'=>$this->user_id,
            'status'=>$this->status,
            'step'=>$this->step,
            'invitees'=>$this->invitees,
            'invitees_messages'=>$messages,
            'all_messages' => $this->messages,
            'all_confirmed'=>$this->confirmed,
            'all_scanned'=> ScannedPepoleResource::collection($this->scanned),
            'all_waiting'=>$this->waiting,
            'all_apologized'=>$this->apologized,
            'all_failed'=>$this->failed,
            'all_not_sent'=>$this->not_sent,
            'messages'=>$this->messages->count(),
            'invitees_count'=>$this->invitees->count(),
            'scanned'=>$this->scanned->count(),
            'confirmed'=>$this->confirmed->count(),
            'apologized'=>$this->apologized->count(),
            'share_link'=> url('share/'.$this->id),
            'waiting'=>$this->waiting->count(),
            'not_sent'=>$this->not_sent->count(),
            'failed'=>$this->failed->count(),
        ];
    }
}
