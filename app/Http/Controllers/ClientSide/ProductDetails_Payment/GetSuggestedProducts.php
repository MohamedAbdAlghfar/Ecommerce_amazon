<?php

namespace App\Http\Controllers\ClientSide\ProductDetails_Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category};

class GetSuggestedProducts extends Controller
{
    public function suggestedProducts(Request $request){
        $prodId = $request->id;
        $categoryId = Product::where('id', $prodId);

        // .. Get All Products Of One Parent In Category ..
        $products = Product::whereHasNested('category', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->selectRaw('name','price','image','discount','rate','sold')->take(50)->get();


        if ($products) {
            return response()->json([ $products ]);
        }
        return response()->json([
            'message'=>'error with fetch data',
        ]);

    }
}
