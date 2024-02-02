<?php

namespace App\Http\Controllers\StoreAdminPanel\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteProductController extends Controller
{
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function deleteProduct(Request $request)
    {
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }
        // .. Get StoreId To Use It ..
        $user = auth()->user();
        $userId = User::find($user->id);
        $storeId = $userId->store->id;

        $product = Product::find($request->product_id);

        if ($product->store_id == $storeId) // ensure that this product is from this store products 
        {
            $delProduct = $product->delete();
        }

        if(!$delProduct){ // if fails to delete product
            return response()->json([
                'status'=>'Fails',
                'message' => 'Failed To Delete Product , Try Again Later.',
            ]);
        }
        return response()->json([ // deletion done successfully
            'status'=>'Success',
            'message' => 'Product Deleted Successfully',
        ]);
    }
}
