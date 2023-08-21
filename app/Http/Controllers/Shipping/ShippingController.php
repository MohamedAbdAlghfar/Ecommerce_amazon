<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;

class ShippingController extends Controller
{
    
    public function index()
    {
        $shipping = ShippingCompany::get();
        return view('Shipping\index',compact('shipping'));
        //       return response()->json($shipping);

    }

    public function show($id)
    {
        
        $shipping = ShippingCompany::findOrFail($id);
      
      
         return view('Shipping\show',compact('shipping'));
       //return response()->json($shipping);
    } 








}
