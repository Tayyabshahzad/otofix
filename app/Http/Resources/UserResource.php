<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'verified_at' => $this->email_verified_at,
            'registered_type' => $this->registered_type,
            'google_id' => $this->google_id,
            'facebook_id' => $this->facebook_id,
            'photo' => $this->getFirstMediaUrl('profile_photo','thumb'),


        ];
    }
}
