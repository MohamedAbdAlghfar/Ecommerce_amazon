<?php

namespace App\Http\Controllers\RejestrationContrallers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class SignUpController extends Controller
{
    public function store(Request $Request)
    {
        $validatedData = $Request->validate([
            'f_name'  => 'required',
            'l_name'  => 'required',
            'email'   => 'required|email',
            'address' => '',
            'gender'  => 'required',
            'phone'   => 'required',
            'password'=> 'required|min:8|confirmed',
        ]);

        $user = User::create($validatedData);
            
        $token = Auth::login($user);
        
        return response()->json([
            'status' =>'success',
            'message'=>'user registered successfully',
            'token'  =>$token, 
            'user'   =>$user,
        ]); 
    }
}
