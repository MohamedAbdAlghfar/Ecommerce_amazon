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

        // Check if the price filter is present and apply it
        if ($request->has('offers')) {
            $price = $request->query('offers');
            $query->where('Discount', '<=', $price);  //search to make min and max value for price
        }
        // --------------------------------------------------------------------------------

        // Get the min and max price from the request
        $minPrice = $request->query('minPrice');
        $maxPrice = $request->query('maxPrice');
        // Check if the price filter is present and apply it
       if ($request->has('price')) {
           // Filter the products by price
           $query->whereBetween('price', [$minPrice, $maxPrice]);
        }


        // Check if the rating filter is present and apply it
        if ($request->has('rating')) {
            $rating = $request->query('rating');    // .. make a rate , modify products table and add rating column ..
            $query->where('rating', '>=', $rating);
        }

        // Check if the products belong to the specified category
        $query->whereHas('categories', function ($q) use ($category) {
        $q->where('categories.id', $category);
        });

        // .. Get The Filtered Products ..
        $products = $query->get();

        return response()->json($products);
    }
}
