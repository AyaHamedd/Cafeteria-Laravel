<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return[
            "id" => $this->id,
            "status" => $this->status,
            "user_id" => $this->user_id,
            "room_id" => $this->room_id,
            "created_at" => $this->created_at,
            "total_price" => $this->getTotalOrderPrice(),
            "user" => $this->user,
            "room" => $this->room,
            "products" => $this->products,

        ];
        
    }
}
