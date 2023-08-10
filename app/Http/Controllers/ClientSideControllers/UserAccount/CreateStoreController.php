<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Models\{Store,User};

class CreateStoreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function Create(Request $request){

    }
}
