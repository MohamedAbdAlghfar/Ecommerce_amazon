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
        $order->save();

    }




}
