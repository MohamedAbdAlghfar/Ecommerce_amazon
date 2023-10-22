<?php

namespace App\Http\Controllers\AuthControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,Cart};
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
class SignUpController extends Controller
{
    public $token;

    public function signup(Request $Request)
    {
        $validatedData = Validator::make(($Request->all()),[
            'f_name'  => 'required',
            'l_name'  => 'required',
            'email'   => 'required|email|unique:users',
            'age'     => 'required',
            'address' => 'nullable',
            'gender'  => 'required',
            'phone'   => 'required',
            'password'=> 'required|min:8|confirmed',
        ]);

        if ($validatedData->fails()) {
            return $validatedData->errors();
        }

        $user = User::create([
            'f_name'  => $Request->f_name,
            'l_name'  => $Request->l_name,
            'email'   => $Request->email,
            'age'     => $Request->age,
            'address' => $Request->address,
            'gender'  => $Request->gender,
            'phone'   => $Request->phone,
            'password'=> Hash::make($Request->input('password')),
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

}
