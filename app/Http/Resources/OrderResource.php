<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        $selectedColumns = [
            'id',
            'location', 
            'trans_date',     
            'Cancellation_date',     
            'price',
            'user_id',
            'store_id',
            'shipping_company_id',
            'product_id', 
            'offer_id', 
            'status',
        ];

        return array_intersect_key($this->resource->toArray(), array_flip($selectedColumns));
    }
}
