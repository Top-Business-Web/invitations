<?php

namespace App\Http\Resources;

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
        return [
            'id'=>$this->id,
            'date'=>$this->date,
            'title'=>$this->title,
            'image'=>$this->image,
            'has_barcode'=>$this->has_barcode,
            'barcode'=>$this->barcode,
            'send_date'=>$this->send_date,
            'address'=>$this->address,
            'longitude'=>$this->longitude,
            'latitude'=>$this->latitude,
            'password'=>$this->password,
            'user_id'=>$this->user_id,
            'status'=>$this->status,
            'step'=>$this->step,
        ];
    }
}
