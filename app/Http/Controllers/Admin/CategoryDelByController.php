<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoryDelByController extends Controller
{

   // ------------------------------------------------ [ (REPORT) ] ------------------------------------------------------- //
    // this controller belong to {{Delete Category}}
      //details
           // showDeletedCategory : use to take category id and return view to show data of admin that delete





    public function showDeletedCategory($categoryId)
{
    $category = Category::withTrashed()->find($categoryId); 
    $admin = User::find($category->deleted_by);

    // Access admin information
    $adminName = $admin->f_name;
    $adminEmail = $admin->email;

    $data = [
        'category' => $category,  
        'admin' => $admin,
        'adminName' => $adminName,
        'adminEmail' => $adminEmail,
    ];




    // Pass the admin information to the view or perform any other desired actions
  
   // return view('Admin\Category\DelBy', compact('data'));
    return response()->json($data);
}





}
