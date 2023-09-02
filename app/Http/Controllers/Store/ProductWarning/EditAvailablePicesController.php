<?php

namespace App\Http\Controllers\Store\ProductWarning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class EditAvailablePicesController extends Controller
{
    public function newPices(Request $request)
    {
        $product = Product::where('id', $request->product_id)->firstOrFail();

        if ($product) {
            $updateNewPices = $product->update([
                'available_pices' => $request->available_pices,
            ]);
        }
    }
}
