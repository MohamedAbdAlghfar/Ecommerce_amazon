<?php

namespace App\Http\Controllers\ClientSide\ProductDetails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category};

class GetSuggestedProducts extends Controller
{
    public function suggestedProducts(Request $request){
        $prodId = $request->id;
        $categoryId = Product::find($prodId)->only('category_id');

        // .. Get All Products Of One Parent In Category ..
        $childIds = Category::where('id', $categoryId)->with('children')->pluck('id')->flatten();
        
        $products = Product::whereIn('category_id', $childIds)->get();


        if ($products) {
            return response()->json([ $products ]);
        }
        return response()->json([
            'message'=>'error with fetch data',
        ]);

    }
}
