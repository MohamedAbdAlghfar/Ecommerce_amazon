<?php

namespace App\Http\Controllers\Rejestrationcontrallers;

use Illuminate\Http\Request;
use app\Http\Models\User;
class signupcontraller extends Controller
{
    public function store(){

        $user = new User ;
        $user->name = $_REQUEST->name ;
        $user->email = $_REQUEST->email ;
        $user->gender = $_REQUEST->gender ;
        $user->password = $_REQUEST->name ;
        $user->phone = $_REQUEST->phone ;
    }
}
