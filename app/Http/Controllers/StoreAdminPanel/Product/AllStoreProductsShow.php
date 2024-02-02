<?php

namespace App\Http\Controllers\StoreAdminPanel\Product;

use App\Http\Controllers\Controller;
use App\Models\{Product, User};
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use App\Http\Middleware\Is_Store_Admin;

class AllStoreProductsShow extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function getProducts(Request $request){

        $validatedData = $request->validate([
            'product_name' => 'required|exists:products,name',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $user = auth()->user();
        $userId = User::find($user->id);
        $storeId = $userId->store->id;

        if ($request->product_name) 
        {
            $similar = Product::where('name', 'like', '%' . request('product_name') . '%')
            ->where('store_id', $storeId)
            ->paginate(20);

            $similar->appends($request->query());

            $productsResource = ProductResource::collection($similar);

            return response()->json([
                'results' => $productsResource,
            ]);
        }
        else
        {
            $storeProducts = Product::where('store_id', $storeId)->get(); 

            $productsResource = ProductResource::collection($storeProducts);

            if (!$productsResource) {
                return response()->json([
                    'status' => 'Failed',
                ]);
            }
            return response()->json([
                'status' => 'Success',
                'products' => $productsResource,
            ]);
        }

    }
}
