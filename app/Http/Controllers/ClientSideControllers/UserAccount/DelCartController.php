<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartProduct;

class DelCartController extends Controller
{  
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    // .. Add Product For User's Card ..
    public function deleteFromCart($productid){ // .. This Is Product Id ..

      $user = auth()->user();

      $cartId = $user->cart->id;

      $deleteProductFromCart = CartProduct::where('product_id', $productid)->where('cart_id', $cartId)->delete();

      if ($deleteProductFromCart) {
        return response()->json([
          'status' => 'success',
          'message' => 'Product deleted from cart successfully',
        ]);
      } else {
        return response()->json([
          'status' => 'error',
          'message' => 'Product could not be deleted from cart',
        ]);
      }
    }
}
