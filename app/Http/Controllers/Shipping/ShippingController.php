<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Models\order;

class ShippingController extends Controller
{
    
    public function index()
    {
        $shipping = ShippingCompany::select('shipping_companies.name','shipping_companies.id','photoable.filename','shipping_companies.phone','shipping_companies.email','shipping_companies.website','shipping_companies.location','shipping_companies.address')->join('photoable', 'photoable.photoable_id', '=', 'shipping_companies.id')->get();
        return view('Shipping\index',compact('shipping'));
      //return response()->json($shipping);

    }

    public function show($id)
    {
        
        $shipping = ShippingCompany::select('shipping_companies.name','shipping_companies.id','photoable.filename')->join('photoable', 'photoable.photoable_id', '=', 'shipping_companies.id')->findOrFail($id); 
        
        $order = order::select('orders.id','orders.created_at','orders.trans_date','orders.price','orders.location','products.name as product_name','users.f_name as user_name','stores.name as store_name')
          ->join('products', 'orders.product_id', '=', 'products.id')
          ->leftJoin('users', 'orders.user_id', '=', 'users.id')
          ->leftJoin('stores', 'products.store_id', '=', 'stores.id')
          ->where('shipping_company_id',$id)->where('status',2)
          ->get();
      
        $data = [
            'shipping' => $shipping, 
            'order' => $order,
                ];


         return view('Shipping\show',compact('data'));
      // return response()->json($data);
    } 


}
