<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class UserOrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "created_at" => Carbon::parse($this->created_at)->format('d-m-y H:i A'),
            "status" => $this->status,
            "total" => $this->getTotalOrderPrice()
        ];
    }
}
