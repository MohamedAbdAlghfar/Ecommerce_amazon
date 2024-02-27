<?php

namespace App\Http\Controllers\StoreAdminPanel\ProductWarning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product,Category};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;
use App\Http\Middleware\Is_Store_Admin;

class WarningController extends Controller
{

    public function __construct(Is_Store_Admin $middleware)
    {
        $this->middleware($middleware);
    }

    public function warning(Request $request){

        $user = auth()->user();
        $userId = $user->id;

        // .. get it -TO- select products from which store ..
        $store_Id = DB::table('store_user')
            ->where('user_id', $user->id)
            ->select('store_id')
            ->first();
        $storeId = $store_Id->store_id;

        // .. get all products that it available pices less than 40 pices ..
        $warnings = Product::where('available_pieces', '<=', 40)->where('store_id', $storeId)->get();

        $categoryId = $request->category_id;

        // .. The Default Value If There are NO Selected Cateory ..
        if (!$categoryId) {

            return response()->json([
                'message' => 'No category ID provided.',
                'warnings' => $warnings,
            ]);
        }
        // .. If There are Selected Category To See It all Products ..
        else {
            
            $childIds = Category::where('id', $categoryId)->with('children')->pluck('id')->flatten();

            // .. get childs of selected categoryId's all products from just [[[-WARNINGS-]]] .. 
            $products = $warnings->whereIn('category_id', $childIds)->get();

            if ($products) { 
                return response()->json([
                    'message' => 'Success',
                    'products'=> $products,
                ]);
            }
            return response()->json([ // .. Failed To Get Products ..
                'message' => 'Failed',
            ]);

        }

    }

}
