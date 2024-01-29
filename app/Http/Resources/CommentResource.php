<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        $selectedColumns = [
            'body', 
            'parent_id', 
            'type',
            'rate',
            'product_id',
            'user_id',        
            'id',
        ];

        return array_intersect_key($this->resource->toArray(), array_flip($selectedColumns));
    }
}