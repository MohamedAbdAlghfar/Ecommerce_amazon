<?php

namespace App\Http\Controllers\AuthControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,Cart};
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
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
            'email'   => 'required|email|unique:users',
            'age'     => 'required',
            'address' => 'nullable',
            'gender'  => 'required',
            'phone'   => 'required',
            'password'=> 'required|min:8|confirmed',
        ]);

        $user = User::create([
            'f_name'  => $validatedData['f_name'],
            'l_name'  => $validatedData['l_name'],
            'email'   => $validatedData['email'],
            'age'     => $validatedData['age'],
            'address' => $validatedData['address'],
            'gender'  => $validatedData['gender'],
            'phone'   => $validatedData['phone'],
            'password'=> Hash::make($validatedData['password']),
        ]);   
        
        // .. Create The Default Cart Of User ..
        $cart = Cart::create([
            'user_id' => $user->id,
          ]);

        $this->token = JWTAuth::fromUser($user);

        return response()->json([
            'status' => 'success',
            'message' => 'user registered successfully',
            'token' => $this->token , 
            'user' => $user ,
            'usercart' => $cart ,
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
