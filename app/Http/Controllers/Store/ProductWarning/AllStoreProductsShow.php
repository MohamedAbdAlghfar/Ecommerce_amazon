<?php

namespace App\Http\Controllers\Store\ProductWarning;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AllStoreProductsShow extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function products(Request $request){

        $user = auth()->user();
        $userId = $user->id;

        $storeId = DB::table('store_user')->where('user_id', $userId)->select(['store_id'])->first();

        if ($request->product_name) 
        {
            $similar = Product::where('name', 'like', '%' . request('product_name') . '%')
            ->where('store_id', $storeId)
            ->get();

            return response()->json([
                'results' => $similar,
            ]);
        }
        else
        {
            $storeProducts = Product::where('store_id', $storeId)->get(); 
        }

    }
}
