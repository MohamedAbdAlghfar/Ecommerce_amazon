<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class RequestController extends Controller
{
  
    
   // ------------------------------------------------ [ (REPORT) ] ------------------------------------------------------- //
    // this controller belong to {{Requests}}
      //details
           // index : use to show order that requsted


    public function index()
    {
        $request = Order::select('orders.price', 'orders.location', 'orders.trans_date', 'orders.status','orders.created_at', 'photoable.filename','products.name as product_name','users.f_name as user_name','products.available_pieces','stores.name as store_name','shipping_companies.name as shipping_com_name')
          ->join('products', 'orders.product_id', '=', 'products.id')
          ->leftJoin('photoable', function ($join) {
         $join->on('products.id', '=', 'photoable.photoable_id')
          ->where('photoable.photoable_type', '=', 'App\\Models\\Product');
         })->leftJoin('users', 'orders.user_id', '=', 'users.id')     
          ->leftJoin('stores', 'products.store_id', '=', 'stores.id')
          ->leftJoin('shipping_companies', 'orders.shipping_company_id', '=', 'shipping_companies.id')
          ->where('orders.status', 2)
          ->orderBy('orders.created_at', 'desc')
          ->get();
     //   return view('admin/Product/request',compact('request'));
      return response()->json($request); 
    }

    
}
