<?php

namespace App\Http\Controllers\UserControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\User;
use App\Models\CartProduct;

class AddCartController extends Controller 
{
    public function __construct()
    {
      $this->middleware('auth:api');
    }

    // .. Add Product For User's Card ..
    public function addToCart($productid){ // .. This Is Product Id ..

      $user = auth()->user();

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
