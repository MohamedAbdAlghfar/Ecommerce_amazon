<?php

namespace App\Http\Controllers\Rejestrationcontrallers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class signupcontraller extends Controller
{
    public function store(Request $Request)
    {
        $user = new User();
        $user->f_name  = $Request->f_name;
        $user->l_name  = $Request->l_name;
        $user->email   = $Request->email;
        $user->password= $Request->password;
        $user->gender  = $Request->gender;
        $user->phone   = $Request->phone;
        $user->store();
    }
}
