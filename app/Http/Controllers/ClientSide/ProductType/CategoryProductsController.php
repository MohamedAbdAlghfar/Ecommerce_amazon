<?php

namespace App\Http\Controllers\ClientSide\ProductType;

use App\Http\Controllers\Controller;
use App\Http\Controllers\ClientSide\ProductType\FilterProductsController;
use Illuminate\Http\Request;
use App\Models\{Product,Category};

class CategoryProductsController extends Controller
{
    public function getProducts(Request $request){
        
        $category_id = $request->category_id;

        // .. Check if any filter is applied ..
        if ($request->hasAny(['brand', 'price', 'sold', 'rate', 'discount'])) {
            // Get the filtered products from the FilterProductsController
            $filter = new FilterProductsController ;
            $filter->filter($request , $category_id);
            // $products = FilterProductsController::filter($request, $category_id);
        }else{
            // If no filter is applied , get all products of that category
            $products = Product::whereHas('category', function ($query) use ($category_id) {
                $query->where('categories.id', $category_id);
            })->select(['name','about','discount','rate','sold'])->get();
        }

        
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
