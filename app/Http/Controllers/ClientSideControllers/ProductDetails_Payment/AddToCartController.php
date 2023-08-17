<?php

namespace App\Http\Controllers\ClientSideControllers\ProductDetails_Payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\CartProduct;

class AddToCartController extends Controller 
{
    public function __construct()
    {
      $this->middleware('auth:api');
    }

    // .. Add Product For User's Card ..
    public function addToCart($productid){ // .. This Is Product Id ..

      $user = auth()->user();

      // .. This Catch Any Admin Role Try To Add Product To His Cart , Coz He Doesent Have a Cart ..
      if (!$user->role == 0) {
        return response()->json([
          'message' =>'Only User Can Have Products In Cart , Not Admin',
        ]);
      }

      $cartId = $user->cart->id;

      $addProductToCart = CartProduct::create([
        'product_id' => $productid,
        'cart_id' => $cartId,
      ]);

      if ($addProductToCart) {
        return response()->json([
          'status' => 'success',
          'message' => 'Product added to cart successfully',
          'cart_product' => $addProductToCart,
          'user_name'=> $user->f_name,
        ]);
      } else {
        return response()->json([
          'status' => 'error',
          'message' => 'Product could not be added to cart',
        ]);
      }
    }
}
