<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScannedPepoleResource extends JsonResource
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

            "id" =>  $this->id,
            "invitation_id" =>  $this->invitation_id,
            "name" =>  "Alla Mohamed",
            "email" =>  $this->invitee->email,
            "phone" =>  $this->invitee->phone,
            "invitees_number" =>  $this->invitee->invitees_number,
            "status" =>  $this->invitee->status,
            "created_at" =>  $this->created_at,
            "updated_at" =>  $this->updated_at,
        ];
    }
}
