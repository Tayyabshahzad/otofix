<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuoteationServicesResource extends JsonResource
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
            'id' => $this->service->id,
            'title' => $this->service->title,
            //'status' => $this->status,
            'icon_name' => $this->service->icon_name,
            //'photo' => $this->getFirstMediaUrl('service','thumb'),
        ];
    }
}
