<?php
namespace App\Http\Controllers\ClientSide\ProductType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Product, Category};

class CategoryProductsController extends Controller
{
    public function getProducts(Request $request)
    {
        $category_id = $request->category_id;

        $query = Product::query();

        // .. Select all Childs Of This Parent Category ..
        $childIds = Category::where('id', $categoryId)->with('children')->pluck('id')->flatten();
        // .. Add all Products Belonged To Childs Of This Parent Category ..
        $query->whereIn('category_id', $childIds);

        // .. If Selected Filter Were Brand ..
        if ($request->has('brand')) {
            $brand = $request->query('brand');
            $query->where('brand', $brand);
        }

        // .. If Selected Filter Were any Child Of Parent Category ..
        if ($request->has('category')) {
            $category = $request->query('category');
            $query->where('category_id', $category);
        }

        // .. If Selected Filter Were By Most Sold ..
        if ($request->has('sold')) {
            $sold = $request->query('sold');
            $query->where('sold', $sold)->orderBy('sold', 'desc');
        }

        // .. If Selected Filter Were by Discount ..
        if ($request->has('discount')) {
            $query->where('discount', '>', 0); 
        }

        $minPrice = $request->query('minPrice');
        $maxPrice = $request->query('maxPrice');

        if ($request->has('price')) {
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        if ($request->has('rate')) {
            $rate = $request->query('rate');
            $query->where('rate', '>=', $rate);
        }

        $products = $query->get();

        if ($products) {
            return response()->json([
                'message' => 'Data Fetching Done',
                'products' => $products,
            ]);
        }

        return response()->json([
            'message' => 'Error with fetching data',
        ]);
    }
}