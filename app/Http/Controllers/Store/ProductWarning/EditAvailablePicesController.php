<?php

namespace App\Http\Controllers\Store\ProductWarning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

class EditAvailablePicesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function newPices(Request $request)
    {
        $user = auth()->user();

        $storeId = DB::table('store_user')->where('user_id', $user->id)->select(['store_id'])->first();

        $product = Product::where('id', $request->product_id)
        ->where('store_id', $storeId)
        ->first();

        $oldPices = $product->available_pices;

        if ($product) {

            $updateNewPices = $product->update([
                'available_pices' => $request->new_pices + $oldPices,
            ]);

            if ($updateNewPices) {
                return response()->json([
                    'message' => 'success',
                ]);
                
            }else {
                return response()->json([
                    'message' => 'Failed'
                ]);
            }

        }

    }

}
