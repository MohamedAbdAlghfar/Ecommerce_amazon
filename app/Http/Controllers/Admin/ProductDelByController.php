<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Tymon\JWTAuth\Facades\JWTAuth;

class ProductDelByController extends Controller
{
    
    public function showDeletedProduct($productId)  
{
    $product = Product::withTrashed()->find($productId); 
    $admin = User::find($product->deleted_by);

    // Access admin information
    $adminName = $admin->f_name;
    $adminEmail = $admin->email;

    // Pass the admin information to the view or perform any other desired actions
    return view('Admin\Product\DelBy', compact('product', 'adminName', 'adminEmail'));
}
 

}
