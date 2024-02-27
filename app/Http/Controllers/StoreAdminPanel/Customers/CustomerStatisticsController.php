<?php

namespace App\Http\Controllers\StoreAdminPanel\Customers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\Is_Store_Admin;

class CustomerStatisticsController extends Controller
{
    public function __construct(Is_Store_Admin $middleware)
    {
        $this->middleware($middleware);
    }
    /* here you should return average age and gender and which number of each type of customers here 
    like children or women or men and how age they all which is average age of your customers */
    public function statistics()
    {
        //
    }
}
