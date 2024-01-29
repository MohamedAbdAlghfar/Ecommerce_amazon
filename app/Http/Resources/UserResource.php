<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $selectedColumns = [
            'id',
            'f_name',
            'email',         
            'id',
            'gender',
            'age',
            'address',  
            'role',
            'phone',
            'l_name',
            'password', 
            
        ];

        return array_intersect_key($this->resource->toArray(), array_flip($selectedColumns));
    }
}