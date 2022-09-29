<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
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
            'user_id' => $this->user_id,
            'user' => $this->user->name,
            'make' => $this->make,
            'model' => $this->model,
            'year' => $this->year,
            //'status' => $this->status,
            'number_plate' => $this->number_plate,
            //'photo' => $this->getFirstMediaUrl('car_photo','thumb')
        ];
    }
}
