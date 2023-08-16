<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use Tymon\JWTAuth\Facades\JWTAuth;

class CategoryDelByController extends Controller
{


    public function showDeletedCategory($categoryId)
{
    $category = Category::withTrashed()->find($categoryId); 
    $admin = User::find($category->deleted_by);

    // Access admin information
    $adminName = $admin->f_name;
    $adminEmail = $admin->email;

    // Pass the admin information to the view or perform any other desired actions
    return view('Admin\Category\DelBy', compact('category', 'adminName', 'adminEmail'));
}





}
