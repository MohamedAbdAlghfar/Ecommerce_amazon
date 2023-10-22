<?php

namespace App\Http\Controllers\Store\ProductWarning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, StoreUser, Category};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class WarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }


    public function warning(Request $request){

        $user = auth()->user();
        $userId = $user->id;

        // .. get it -TO- select products from which store ..
        $storeId = DB::table('store_user')->where('user_id', $userId)->select(['store_id'])->first();

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
