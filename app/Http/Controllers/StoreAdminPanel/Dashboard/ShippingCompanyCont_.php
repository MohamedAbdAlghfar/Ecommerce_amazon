<?php

namespace App\Http\Controllers\StoreAdminPanel\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Models\{Order, ShippingCompany};
use App\Http\Middleware\Is_Store_Admin;

class ShippingCompanyCont_ extends Controller
{
    // .. that should get all orders that shipping company shipped for The store ,
    // and get full debt money for shipping company that store should pay it ..

    public function __construct(Is_Store_Admin $middleware)
    {
        $this->middleware($middleware);
    }

    public function shippedOrders()
    {
        $user = auth()->user();
        $userId = $user->id;
        $storeId = DB::table('store_user')->where('user_id', $userId)->select(['store_id'])->first();

        $shippedOrders = Order::where('trans_date', '!=', null)
        ->where('store_id',$storeId)
        ->with('shippingCompany')
        ->paginate(10);

        $shippedOrders->appends($request->query());

        $orders = $shippedOrders->map(function ($order) {
            $shippingCompany = $order->ShippingCompany;

            return [
                'id' => $order->id,
                'location' => $order->location,
                // ... other order fields
                'shipping_company_name' => $shippingCompany ? $shippingCompany->name : null,
                'shipping_company_id' => $shippingCompany ? $shippingCompany->id : null,
            ];
        });

        return response()->json([
            'status' => 'success',
            'orders' => $orders,
        ]);

    }
    public function shippingDubt()
    {
        $user = auth()->user();
        $userId = $user->id;
        $storeId = DB::table('store_user')->where('user_id', $userId)->select(['store_id'])->first();

        $totalDebt = DB::table('shipping_company_store')
        ->where('store_id', $storeId)
        ->sum('debt');

        $debts = DB::table('shipping_company_store')
        ->where('store_id', $storeId)
        ->get();

        $shippingdebt = $debts->map(function ($debt) {
            $shippingId = $debt->shipping_company_id;
            $companyDebt = $debt->debt;
            $shippingComp = ShippingCompany::find($shippingId);
            $shippingName = $shippingComp->name;
            $shippingPhone = $shippingComp->phone;
            $shippingId    = $shippingComp->id ;
            
            return [
                'shipping_comp_name'  => $shippingName,
                'shipping_comp_phone' => $shippingPhone,
                'shipping_comp_id'    => $shippingId,
                'Shipping_Debt'       => $companyDebt,
                'shipping_Debt_all'   => $totalDebt,
            ];
        });

        return $shippingdebt;
    }
}
