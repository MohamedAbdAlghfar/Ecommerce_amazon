<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class ProfileController extends Controller
{
  
    public function index()
    {
        
        $admins = User::select('id','f_name','l_name','email','phone')->where('role', 1)->get();        
        
        return view('Admin\Profile\index',compact('admins'));
       // return response()->json($admins);

    }

}
