<?php

namespace App\Http\Controllers\ClientSideControllers\ProductDetails_Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class GetProductDetails extends Controller
{
    public function productDetails(Request $request){

        $productId = $request->id;
        $productAllDetails = Product::find($productId);

        if ($productAllDetails) {

            return response()->json([

                'status'=>'Success',
                'message' =>'Data Fetching Done',
                'products'=>$productAllDetails,
            ]);

        }
        return response()->json([
            'status' =>'Error',
            'message'=>'Error in Fetching Data',
        ]);
        
    }
}
