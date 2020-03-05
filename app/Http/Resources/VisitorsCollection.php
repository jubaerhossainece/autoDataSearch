<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class VisitorsCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($visitor) {
                return [
                    'id' => $visitor->id,
                    'guestName' => $visitor->guestName,
                    'guestDesignation' => $visitor->guestDesignation,
                    'guestOrg' => $visitor->guestOrg,
                    'restroom' => $visitor->restroom,
                    'bodyguardName' => $visitor->bodyguardName,
                    'carNumber' => $visitor->carNumber,
                    'messengerName' => $visitor->messengerName,
                    'messengerDesignation' => $visitor->messengerDesignation,
                    'authorizerName' => $visitor->authorizerName,
                    'authorizerDesignation' => $visitor->authorizerDesignation,
                    'visitingDate' => $visitor->visitingDate,
                    'created_at' => $visitor->created_at->format('d M Y - H:i:s'),
                    'updated_at' => $visitor->updated_at->format('d m y - h:i:s')
                ];
            })
        ];
    }
}
