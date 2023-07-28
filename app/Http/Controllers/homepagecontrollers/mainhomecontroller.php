<?php

namespace App\Http\Controllers\homepagecontrollers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\homepagecontrollers\mainhomecontroller;
use App\Http\Controllers\homepagecontrollers\Bestsellercontroller;
use App\Models\category;

class mainhomecontroller extends Controller
{
    public function __construct() {
        // .. Get Best Seller Products ..

        $Best_Seller= array();

        for ($i = 1; $i <= 10; $i++) {
            $category = Category::select('Name', 'Price')
                ->where('Parent_Id', $i)
                ->orderBy('Buy', 'desc')
                ->take(10)
                ->get();
        
            $this->Best_Seller[$i] = $category;
        }        
            
    }
    public function getdata($id)
    {
        return $this->Best_Seller[$id];
    }
}
