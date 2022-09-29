<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
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
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'workshop_id' => $this->workshop_id,
            'workshop_name' => $this->workshop->name,
            'booking_id' => $this->booking_id,
            'booking_number' => $this->booking->booking_number,
            'rating' => $this->rating,
            'comments' => $this->comments

        ];
    }
}
