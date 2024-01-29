<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RequestResource extends JsonResource
{
    public function toArray($request)
    {
        $selectedColumns = [
            'id',
            'store_id',
            'user_id',
            'store_name',
            'message',
            'response',
        ];

        return array_intersect_key($this->resource->toArray(), array_flip($selectedColumns));
    }
}
