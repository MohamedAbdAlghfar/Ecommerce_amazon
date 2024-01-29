<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferResource extends JsonResource
{
    public function toArray($request)
    {
        $selectedColumns = [
            'id',   
            'price',
            'store_id',
            'name',
            'about',
            'no_pices',
        ];

        return array_intersect_key($this->resource->toArray(), array_flip($selectedColumns));
    }
}



// this shows how to add external data with response ..

/*
use App\Http\Resources\ProductResource;
use App\Models\Product;

public function show($id)
{
    $product = Product::findOrFail($id);
    $productResource = new ProductResource($product);

    // Append additional data
    $extraData = [
        'extra_key' => 'extra_value',
        // Add more keys as needed
    ];

    return $productResource->additional($extraData);
}

*/
