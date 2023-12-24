<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'store_name' => $this->store->name,
            'user_name' => $this->user->name,
            'created_at' => $this->created_at,
            'cancelled_at' => $this->cancelled_at,
            'order_id' => $this->id,
        ];
    }
}
