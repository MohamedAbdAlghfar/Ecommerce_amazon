<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class RecentController extends Controller
{
   
     // ------------------------------------------------ [ (REPORT) ] ------------------------------------------------------- //
    // this controller belong to {{recent page}}
      //details
           // index : use to show recent sold product


    public function index() 
    {
       $recentorder = Order::select('orders.price', 'orders.location', 'orders.trans_date', 'orders.status', 'photoable.filename','products.name as product_name','users.f_name as user_name','products.available_pieces','stores.name as store_name','shipping_companies.name as shipping_com_name')
         ->join('products', 'orders.product_id', '=', 'products.id')
         ->leftJoin('photoable', function ($join) {
        $join->on('products.id', '=', 'photoable.photoable_id')
         ->where('photoable.photoable_type', '=', 'App\\Models\\Product');
        })->leftJoin('users', 'orders.user_id', '=', 'users.id')     
         ->leftJoin('stores', 'products.store_id', '=', 'stores.id')
         ->leftJoin('shipping_companies', 'orders.shipping_company_id', '=', 'shipping_companies.id')
         ->where('orders.status', 3)
         ->orderBy('orders.created_at', 'desc')
         ->get(); 
     //   return view('admin/Product/recent',compact('recentorder'));
      return response()->json($recentorder); 

    }

    
    
}
