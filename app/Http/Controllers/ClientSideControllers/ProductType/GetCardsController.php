<?php

namespace App\Http\Controllers\ClientSideControllers\ProductType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category};

class GetCardsController extends Controller
{
    public function getCards(Request $request){
        
        $category_id = $request->category_id;
                    // use 'with' if you dont need the count of each category
        $products = Product::withCount('categories') //---->> .. this 'withcount' function will fetch the products and their related categories in one query, instead of making multiple queries and get count of products in each category..
            ->whereHas('categories', function ($query) {
                $query->where('categories.id', $category_id)
                    // .. Select Subcategories Related To This $Category_id ..  
                    ->orWhereHas('subcategories', function ($query) { 
                        $query->where('categories.id', $category_id);
                    });
            })
        ->selectRaw('name','price','image','discount','rate','sold')
        ->get();

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
