<?php

namespace App\Http\Controllers\AuthControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
class SignUpController extends Controller
{
    public $token;

    public function signup(Request $Request)
    {
        $validatedData = $Request->validate([
            'f_name'  => 'required',
            'l_name'  => 'required',
            'email'   => 'required|email',
            'address' => 'required',
            'gender'  => 'required',
            'phone'   => 'required',
            'password'=> 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'f_name'  => $validatedData['f_name'],
            'l_name'  => $validatedData['l_name'],
            'email'   => $validatedData['email'],
            'address' => $validatedData['address'],
            'gender'  => $validatedData['gender'],
            'phone'   => $validatedData['phone'],
            'password'=> Hash::make($validatedData['password']),
        ]);   

        $this->token = JWTAuth::fromUser($user);
        
        return response()->json([
            'status' =>'success',
            'message'=>'user registered successfully',
            'token'  =>$this->token , 
            'user'   =>$user ,
        ]);
    }
}
