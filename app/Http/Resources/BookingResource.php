<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'booking_number' => $this->booking_number,
            'discount' => $this->discount,
            'total' => $this->total,
            'tax' => $this->tax,
            'payment_method' => $this->payment_method,
            'payment_clear' => $this->payment_clear,
            'admin_commission' => $this->admin_commission,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'user' => $this->user,
            'workshop' => $this->workshop,
            'quote' => $this->quote,
            //'services' => $this->quote->services,
            'accepted_quotes_id' => $this->accepted_quotes_id,
        ];
    }
}
