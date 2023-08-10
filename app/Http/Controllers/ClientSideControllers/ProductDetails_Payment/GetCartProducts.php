<?php

namespace App\Http\Controllers\ClientSideControllers\ProductDetails_Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class GetCartProducts extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api');
    }

    public function getAllProducts(){

        $user = auth()->user();
        $cartId = $user->cart->id;

        $cartAllProducts = Cart::with('products')->findOrFail($cartId);

        if($cartAllProducts){
            return response()->json([
                'message'  =>'Data Getten Successfully',
                'products' =>$cartAllProducts,
            ]);
        }
        // .. If Any Error Happen With Getting Data ..
        return response()->json([
            'message' =>'Failed To Get The Data !'
        ]);
    }
}
