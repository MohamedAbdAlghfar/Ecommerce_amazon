<?php

namespace App\Http\Controllers\StoreAdminPanel\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\Product;
use App\Http\Middleware\Is_Store_Admin;

class MakeDiscountController extends Controller
{
    // .. that should contains add discount and disable discount ..
    public function __construct()
    {
        $this->middleware(Is_Store_Admin::class);
    }

    public function makeDiscount(Request $request){
        // .. Get StoreId To Use It ..
        $user = auth()->user();
        $userId = User::find($user->id);
        $storeId = $userId->store->id;

        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'discount' => 'required|numeric|between:5,99', // to make in any case the price will not be 0 , to avoid any errors in PayMent process
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $product = Product::find($request->product_id);

        
        if ($product->store_id == $storeId) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'This Product Not From This Store Products.',
            ]);
        }

        $updateProduct = $product->update([
            'discount' => $request->discount ,
        ]);

        if (!$updateProduct) {
            return response()->json([
                'status' => 'Failed',
                'message' => 'Error While Updating Discount. Try Again Later !',
            ]);
        }
        return response()->json([
            'status' => 'Success',
            'message' => 'Discount Updated Successfully.',
        ]);
    }

}
