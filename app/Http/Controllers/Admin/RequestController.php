<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class RequestController extends Controller
{
    
    public function index()
    {
        $request = Order::select('price','location','created_at','product_id','shipping_company_id','user_id','trans_date')->orderBy('created_at', 'desc')->get();
 //   return view('admin/Product/request',compact('request'));
    return response()->json($request);
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
