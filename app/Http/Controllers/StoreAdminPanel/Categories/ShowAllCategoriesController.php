<?php

namespace App\Http\Controllers\StoreAdminPanel\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Middleware\Is_Store_Owner;

class ShowAllCategoriesController extends Controller
{
    public function __construct(Is_Store_Owner $middleware)
    {
        $this->middleware($middleware);
    }

    public function showAllCategories(Request $request)
    {
        $user = auth()->user();

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
