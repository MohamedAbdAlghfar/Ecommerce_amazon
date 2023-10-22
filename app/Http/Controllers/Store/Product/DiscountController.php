<?php

namespace App\Http\Controllers\Store\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    // .. that should contains add discount and disable discount ..
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function makeDiscount(){
        $user = auth()->user();
    }
    public function disableDiscount(){

    }
}
