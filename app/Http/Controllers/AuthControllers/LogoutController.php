<?php

namespace App\Http\Controllers\AuthControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    public function logout(Request $request){
        
        $token = $request->header('Authorization');

        // .. Check If Token Valid Or No ..
        if (!preg_match('/^Bearer\s+(.{32})$/', $token)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid token format',
            ]);
        }
        if (!JWTAuth::check($this->token)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid token',
            ]);
        }
        if ($token) {
            try {
                JWTAuth::invalidate($token);

                // .. Return a Success Response ..
                return response()->json([
                    'status' => 'success',
                    'message' => 'User logged out successfully',
                ]);
            } catch (JWTException $e) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to logout, please try again',
                ], 500);
            }
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'No token provided',
            ], 401);
        }
    }
}
