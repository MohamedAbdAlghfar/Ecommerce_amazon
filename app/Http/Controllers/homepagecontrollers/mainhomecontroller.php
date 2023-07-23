<?php

namespace App\Http\Controllers\homepagecontrollers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\homepagecontrollers\mainhomecontroller;
use App\Http\Controllers\homepagecontrollers\Bestsellercontroller;

class mainhomecontroller extends Controller
{
    public function __construct() {
        // .. Best Seller Part

        $Best_Seller = array();

           for ($i = 1; $i <= 10; $i++) {
                $category = DB::table('categories')
                    ->select('image', 'name', 'price')
                    ->where('parent_id', $i)
                    ->orderBy('credit', 'desc')
                    ->take(10)
                    ->get();

                $Best_Seller[$i] = $category;
            }

    }
    public function getdata()
    {
        return view('homepage', compact('Best_Seller'));
    }
}
