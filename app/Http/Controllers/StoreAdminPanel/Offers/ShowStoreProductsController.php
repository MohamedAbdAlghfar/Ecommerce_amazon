<?php

namespace App\Http\Controllers\StoreAdminPanel\Offers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\Is_Store_Admin;
use App\Http\Models\{Product,User};
use App\Http\Resources\ProductResource;

class ShowStoreProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function getProducts()
    {
        $user = auth()->user();
        $userId = User::find($user->id);
        $storeId = $userId->store->id;

        $products = Product::where('store_id', $storeId)->paginate(20);

        $products->appends($request->query());

        $productsResource = ProductResource::collection($products);

        if(!$productsResource){
            return response()->json([
                'status' => 'Failed',
                'message'=>'Error Try Again Later !'
            ]);
        }
        return response()->json([
            'status '  => 'Success',
            'activity' => $productsResource,
        ]);

    }
}
