<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $selectedColumns = [
            'name',
            'id', 
            'parent_id', 
            'deleted_by',
        ];

        return array_intersect_key($this->resource->toArray(), array_flip($selectedColumns));
    }
}
