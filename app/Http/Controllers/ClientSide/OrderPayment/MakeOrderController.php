<?php

namespace App\Http\Controllers\ClientSide\OrderPayment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class MakeOrderController extends Controller
{
    public function create(Request $request)
    {
        //dd($request->all());

        // Validate incoming request data
        $validatedData = $request->validate([
            'price' => 'nullable',
        ]);


            // Create the order
            $order = new Order();
            $order->price = $validatedData['price'];

            $order->save();

            return response()->json(['message' => 'Order created successfully', 'order'=> $order], 200);
    }

}
