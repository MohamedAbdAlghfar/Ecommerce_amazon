<?php

namespace App\Http\Controllers\AuthControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LogoutController extends Controller
{
    public function logout(Request $request){
        // Get the token from the request header
        $token = $request->header('Authorization');

        // Check if the token is valid
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
                // Invalidate the token
                JWTAuth::invalidate($token);

                // Return a success response
                return response()->json([
                    'status' => 'success',
                    'message' => 'User logged out successfully',
                ]);
            } catch (JWTException $e) {
                // Return an error response
                return response()->json([
                    'status' => 'error',
                    'message' => 'Failed to logout, please try again',
                ], 500);
            }
        } else {
            // Return an error response
            return response()->json([
                'status' => 'error',
                'message' => 'No token provided',
            ], 401);
        }
    }
}
