<?php

namespace App\Http\Controllers\StoreAdminPanel\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\Is_Store_Admin;
use App\Http\Models\{User, Product,};
use Illuminate\Support\Facades\DB;

class DeleteProductController extends Controller
{

    public function __construct(Is_Store_Admin $middleware)
    {
        $this->middleware($middleware);
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
        $store_Id = DB::table('store_user')
            ->where('user_id', $user->id)
            ->select('store_id')
            ->first();
        $storeId = $store_Id->store_id;

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
