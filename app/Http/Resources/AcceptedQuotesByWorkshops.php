<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AcceptedQuotesByWorkshops extends JsonResource
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
            'id' => $this->id,
            //'quote_id' => $this->quote_id,
            'user_id' => $this->user_id,
            'quote_date' => $this->quote_date,
            //'total' => $this->total,
            //'discount' => $this->discount,
            //'grand_total' => $this->grand_total,
            //'tax' => $this->tax,
            'status' => $this->status,
            //'workshop' => $this->workshop->name,
           // 'workshop_address' => $this->workshop->address,
           // 'lat' => $this->workshop->lat,
            //'lng' => $this->workshop->lng,
            'services' => QuoteationServicesResource::collection($this->services),
        ];
    }
}
