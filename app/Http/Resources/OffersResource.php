<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OffersResource extends JsonResource
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
            'quote_id' => $this->quote_id,
            'total' => $this->total,
            'tax' => $this->tax,
            'status' => $this->status,
            'discount' => $this->discount,
            'grand_total' => $this->grand_total,
            'created_at' => $this->created_at,
            'workshop_name' => $this->workshop->name,
            'workshop_id' => $this->workshop->id,
            'workshop_address' => $this->workshop->address,
            'workshop_lat' => $this->workshop->lat,
            'workshop_lng' => $this->workshop->lng
        ];


    }
}
