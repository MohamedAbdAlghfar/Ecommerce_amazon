<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class RecentController extends Controller
{
   
    public function index() 
    {
      $recentorder = Order::select('price', 'location', 'created_at', 'product_id', 'shipping_company_id', 'user_id','trans_date')
      ->whereDate('trans_date', '<', now()->toDateString())
      ->orderBy('created_at', 'desc')
      ->get();
    return view('admin/Product/recent',compact('recentorder'));
  //  return response()->json($recentorder);

    }

    
    
}
