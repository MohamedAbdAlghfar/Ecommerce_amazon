<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
class RecentController extends Controller
{
   
    public function index()
    {
    $recentorder = Order::select('price','location','created_at','product_id','shipping_company_id','user_id')->orderBy('created_at', 'desc')->get();
    //return view('admin/Product/recent',compact('recentorder'));
    return response()->json($recentorder);

    }

    
    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
