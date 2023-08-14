<?php

namespace App\Http\Controllers\ClientSideControllers\ProductType;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class FiltersController extends Controller
{
    public function filter(Request $request ,$category)
    {
        // Start with an empty query
        $query = Product::query();

        // Check if the brand filter is present and apply it
        if ($request->has('brand')) {
            $brand = $request->query('brand');
            $query->where('brand', $brand);
        }

        // --------------------------------------------------------------------------------
        // Check if the most sold filter is present and apply it
        if ($request->has('sold')) {
            $sold = $request->query('sold');
            $query->where('sold', $buy)->orderBy('sold', 'desc'); //.. Get most sold In any Category ..
        }

        // ..

        if ($request->has('discount')) {
            $discount = $request->query('discount');  // this statement need to focous coz it doesent work
            $query->where('discount', '>', 0);
        }
        // --------------------------------------------------------------------------------

        // Get the min and max price from the request
        $minPrice = $request->query('minPrice');
        $maxPrice = $request->query('maxPrice');

        if ($request->has('price')) {
           $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        // ..

        if ($request->has('rate')) {
            $rate = $request->query('rate');
            $query->where('rate', '>=', $rate);
        }
        
        // ..

        // Check if the products belong to the specified category
        $query->whereHas('categories', function ($q) use ($category) {
        $q->where('categories.id', $category);
        });

        // .. Get The Filtered Products ..
        $products = $query->get();

        return response()->json($products);
    }
}
