<?php

namespace App\Http\Controllers\AuthControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    public function logout(Request $Request){
        
        $token = $Request->header('Authorization');

        // .. Invalidate The Token ..
        JWTAuth::invalidate($token);

        return response()->json([
            'status' => 'success',
            'message'=>'user logged out successfully',
        ]);
    }
}
