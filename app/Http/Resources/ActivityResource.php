<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $selectedColumns = [
            'id',
            'log_name',
            'description',
            'subject_type',
            'subject_id',
            'causer_id',
            'causer_type',
            'properties',
            'event',
            'batch_uuid',
            'created_at',
            'updated_at',
            'order_id',
        ];

        return array_intersect_key($this->resource->toArray(), array_flip($selectedColumns));
    }
}