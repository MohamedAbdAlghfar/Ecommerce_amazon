<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;

class updateOrderStatusController extends Controller
{
    
    public function change($id)
    {
        $order = order::findOrFail($id);
        $order->status = 3 ;
       
        $order->update();
       // $route = route('Shipping.show', ['id' => $shippingCompany->id]);
        return redirect()->route('Shipping.index')->withStatus(__('order successfully updated.'));
        // return response()->json(['message' => 'order successfully updated.']);

    }




}
