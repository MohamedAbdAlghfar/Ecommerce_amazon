<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;

class StoresShippingDebtController extends Controller
{
    
    public function getShippingStores($shippingId)
    {
        // Retrieve the specific shipping instance
        $shipping = ShippingCompany::findOrFail($shippingId);
    
        // Load the stores relationship with pivot data (price)
        $shipping->load('stores');
    
        // Get the stores with prices
        $stores = $shipping->stores->map(function ($store) {
            return [
                'store_name' => $store->name,
                'store_id' => $store->id,
                'debt' => $store->pivot->debt,
            ];
        });
    
$data = [

    'stores' => $stores,
    'shipping_id' => $shipping->id,

];



       // return view('Shipping\showStoreDebt',compact('data'));
        return response()->json($data);
    }






}
