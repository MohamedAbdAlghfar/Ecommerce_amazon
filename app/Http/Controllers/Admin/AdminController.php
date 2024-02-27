<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use App\Models\Store;
class AdminController extends Controller
{
   // ------------------------------------------------ [ (REPORT) ] ------------------------------------------------------- //
    // this controller belong to {{Dashboard Page}}
      //details
         // 1- index : 
           // it return number of user in web (user_count) && number of stores in web (store_count)
           // && total price of sold in this day (totalPrice_in_day) && total price of sold in this month (totalPrice_in_month)
           // && total price of sold in general (total_order_price)



    public function index()
    {
         
        $user_count = User::where('role', 0)->count();
        $store_count = Store::count();
        $totalPrice_in_day = Order::whereDate('created_at', today())->sum('price');
        $totalPrice_in_month = Order::whereMonth('created_at', now()->month)
         ->whereYear('created_at', now()->year)
         ->sum('price');
        $total_order_price = Order::sum('price');

        $data = [
           'user_count' => $user_count,  
           'store_count' => $store_count,
           'totalPrice_in_day' => $totalPrice_in_day,
           'totalPrice_in_month' => $totalPrice_in_month,
           'total_order_price' => $total_order_price
                ];

    //     return view('Admin\index',compact('data'));
       return response()->json($data);
     
    }   
}
