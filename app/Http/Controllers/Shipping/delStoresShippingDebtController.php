<?php

namespace App\Http\Controllers\Shipping;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ShippingCompany;
use App\Models\Store;

class delStoresShippingDebtController extends Controller
{
    public function DelStoreDebt($shippingId, $storeId)
    {
        $shipping = ShippingCompany::find($shippingId);
        $store = Store::find($storeId);
    
        if ($shipping && $store) {
            $shipping->stores()->updateExistingPivot($store->id, ['debt' => 0]);
    
            // Optionally, you can retrieve the updated pivot record
            $pivotRecord = $shipping->stores()->where('store_id', $store->id)->first()->pivot;
    
            // Return a response or perform additional actions
       
           return redirect()->route('Shipping.getShippingStores',$shippingId)->withStatus(__('Debt successfully deleted.'));
         //return response()->json(['message' => 'Debt successfully deleted.']);

        }


    }
       

}
