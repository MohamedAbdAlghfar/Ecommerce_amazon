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
        $messages = [
            'f_name.required' => 'First name is required',
            'l_name.required' => 'Last name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email must be a valid email address',
            'address.required' => 'Address is required',
            'gender.required' => 'Gender is required',
            'phone.required' => 'Phone is required',
            'password.required' => 'Password is required',
            'password.min' => 'Password must be at least 8 characters long',
            'password.confirmed' => 'Password confirmation does not match'
        ];
        
        $validatedData = $Request->validate($messages,[
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
