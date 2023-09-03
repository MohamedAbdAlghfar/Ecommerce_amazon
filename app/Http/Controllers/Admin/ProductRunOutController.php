<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductRunOutController extends Controller
{
    public function showRunOut()
    {

        $product = Product::select('products.id', 'products.name as product_name','products.available_pieces','photoable.filename')->where('store_id',Null)->where('available_pieces','<',5)->join('photoable', 'photoable.photoable_id', '=', 'products.id')->get();


          return view('admin/Product/RunOut',compact('product'));
       // return response()->json($product);
    }  
    

    

    




}
