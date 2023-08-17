<?php

namespace App\Http\Controllers\AuthControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginController extends Controller
{   
    public function login(Request $Request){
        $Request->validate([
            'email'   => 'required|email',
            'password'=> 'required|min:8',
        ]); 

        $credentials = $Request->only('email','password');

        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }
        
        // .. Get the user from the token ..
        $user = JWTAuth::user();
        
        return response()->json([
            'status' =>'success',
            'message'=>'user logged in successfully',
            'token'  =>$token,
            'user'   =>$user,
        ]);
    }
        
    // Override the failedValidation method
        
    protected function failedValidation(Validator $validator){
        // Throw an exception with a custom response
        throw new HttpResponseException(response()->json([
            'status' => 'error',
            'message' => 'Validation failed',
            'errors' => $validator->errors()
        ], 422));
    }

}