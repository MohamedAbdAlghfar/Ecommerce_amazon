<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Store;
use Tymon\JWTAuth\Facades\JWTAuth;

class StoreDelByController extends Controller 
{
    public function showDeletedStore($storeId)  
    {
        $store = Store::withTrashed()->find($storeId); 
        $admin = User::find($store->deleted_by);
    
        // Access admin information
        $adminName = $admin->f_name;
        $adminEmail = $admin->email;
    
        // Pass the admin information to the view or perform any other desired actions
        return view('Admin\Store\DelBy', compact('store', 'adminName', 'adminEmail'));
    }    


}
