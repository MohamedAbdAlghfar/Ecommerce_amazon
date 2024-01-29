<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\User;

class ActivityResource extends JsonResource
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

        $data = array_intersect_key($this->resource->toArray(), array_flip($selectedColumns));

        // If causer_id is present, fetch additional user information
        if ($this->causer_id) {
            $user = User::select('id', 'f_name', 'email')->find($this->causer_id);
            if ($user) {
                $data['causer'] = $user->toArray();
            }
        }

        return $data;
    }
}
