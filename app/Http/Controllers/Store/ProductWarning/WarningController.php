<?php

namespace App\Http\Controllers\Store\ProductWarning;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class WarningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function warning(){
        $user = auth()->user();
        $store = $user->store->id;

        $warnings = Product::where('available_pices', '<=', 40)->get();
    }
}
