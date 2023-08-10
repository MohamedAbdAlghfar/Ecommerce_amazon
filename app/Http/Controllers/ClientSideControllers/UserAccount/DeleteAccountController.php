<?php

namespace App\Http\Controllers\ClientSideControllers\UserAccount;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeleteAccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    
    public function destroy($id)
    {
        //
    }
}
