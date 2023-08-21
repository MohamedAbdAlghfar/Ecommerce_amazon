<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use App\Models\Store;

class OwnerController extends Controller
{
    
    public function index()
    {

    
        $user_count = User::where('role', 0)->count();
        $Admin_count = User::where('role', 1)->count();
        $store_count = Store::count();
        $totalPrice_in_day = Order::whereDate('created_at', today())->sum('price');
        $totalPrice_in_month = Order::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->sum('price');
        $total_order_price = Order::sum('price');
        
        $data = [
            'user_count' => $user_count,
            'Admin_count' => $Admin_count,
            'store_count' => $store_count,
            'totalPrice_in_day' => $totalPrice_in_day,
            'totalPrice_in_month' => $totalPrice_in_month,
            'total_order_price' => $total_order_price
        ];
       return view('Owner\index',compact('data'));
     //       return response()->json($data);
    
    }


}
