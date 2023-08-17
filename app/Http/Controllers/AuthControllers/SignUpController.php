<?php

namespace App\Http\Controllers\AuthControllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User,Cart};
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
            // 'email' => 'required|email|unique:users',  // this is another way to check is email is already exists
            'address' => 'required',
            'gender'  => 'required',
            'phone'   => 'required',
            'password'=> 'required|min:8|confirmed',
        ]);

        $checkEmail = User::where('email', $validatedData['email'])->first();
        if ($checkEmail) {
            return response()->json([
                'status' => 'error',
                'message' => 'email is already registered',
            ]);
        }

        $user = User::create([
            'f_name'  => $validatedData['f_name'],
            'l_name'  => $validatedData['l_name'],
            'email'   => $validatedData['email'],
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
}
