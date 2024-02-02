<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        $selectedColumns = [
            'id',
            'price',
            'discount',
            'available_pieces',
            'weight',
            'color',
            'col_1',
            'sold',
            'rate',
            'description',
            'col_2',
            'col_3',
            'col_4',
            'about',
            'name',
            'brand',
            'store_id',
            'category_id',
            'deleted_by',
            'added_by',
            'created_at',
            'updated_at',
        ];

        return array_intersect_key($this->resource->toArray(), array_flip($selectedColumns));
        // Add logic to load and display photo paths
        $data['photo_paths'] = $this->loadPhotoPaths();

        return $data;
    }

    protected function loadPhotoPaths()
    {
        // Assuming 'photos' is a relationship on your Product model
        return $this->resource->photos->pluck('filename')->toArray();
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
