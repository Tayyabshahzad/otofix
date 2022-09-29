<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PromotionResource extends JsonResource
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
            'title' => $this->title,
            'status' => $this->status,
            'workshop' => $this->workshop->name,
            //'workshop_id' => $this->workshop->id,
            'status' => $this->status,
            'photo' => $this->getFirstMediaUrl('promotion','thumb')
        ];
    }
}
