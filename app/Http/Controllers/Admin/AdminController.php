<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\order;
use App\Models\User;
use App\Models\Store;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         
        $user_count = User::where('kind', 0)->count();
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

          return view('Admin\index',compact('data'));
    //  return response()->json($data);
     
    }

    /**
     * Show the form for creating a new resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
