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

    public function __construct(Is_Store_Admin $middleware)
    {
        $this->middleware($middleware);
    }


    public function getProducts(Request $request){

        $validatedData = $request->validate([
            'product_name' => 'nullable|exists:products,name',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $user = auth()->user();
        $userId = User::find($user->id);
        $store_Id = DB::table('store_user')
            ->where('user_id', $user->id)
            ->select('store_id')
            ->first();
        $storeId = $store_Id->store_id;

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
