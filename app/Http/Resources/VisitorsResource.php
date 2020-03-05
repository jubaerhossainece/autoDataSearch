<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VisitorsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'guestName' => $this->guestName,
            'guestDesignation' => $this->guestDesignation,
            'guestOrg' => $this->guestOrg,
            'restroom' => $this->restroom,
            'bodyguardName' => $this->bodyguardName,
            'carNumber' => $this->carNumber,
            'visitingDate' => $this->visitingDate,
            'messengerName' => $this->messengerName,
            'messengerDesignation' => $this->messengerDesignation,
            'authorizerName' => $this->authorizerName,
            'authorizerDesignation' => $this->authorizerDesignation,
            'created_at' => $this->created_at->format('d M Y - H:i:s'),
            'updated_at' => $this->updated_at->format('d m y - h:i:s')
        ];
    }
}
