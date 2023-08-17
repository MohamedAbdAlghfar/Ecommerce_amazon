<?php

namespace App\Http\Controllers\ClientSideControllers\ProductType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category};

class GetCardsController extends Controller
{
    public function getCards(Request $request){
        
        $category_id = $request->category_id;

        // .. Get All Products Of One Parent In Category ..
        $products = Product::whereHasNested('category', function ($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->selectRaw('name','price','image','discount','rate','sold')->get();

        
        if ($products) {
            return response()->json([
                'message' =>'Data Fetching Done',
                'products'=>$products,
            ]);
        }
        return response()->json([
            'message'=>'error with fetch data',
        ]);
        
        
    }
}
