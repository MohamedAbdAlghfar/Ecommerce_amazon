<?php

namespace App\Http\Controllers\StorePanel\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class ShowAllCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function showAllCategories(Request $request)
    {
        $user = auth()->user();

        if ($user->role == 0) 
        {
            return response()->json([
                'message'=>'You Dont Have Permission To Visit This Page !',
            ]);
        }

        if (!$request->category_name) 
        {
            $categoreis = Category::all();
        }
        else 
        {
            $categoreis = Category::where('name','like','%' . reqeust('category_name') . '%')
            ->select('name','id')
            ->get();
        }
        
        return response()->json([
            'message' => 'success',
            'categories' => $categoreis,
        ]);

    }

}
