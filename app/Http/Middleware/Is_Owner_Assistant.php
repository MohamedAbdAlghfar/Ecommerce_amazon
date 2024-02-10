<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class Is_Owner_Assistant
{
    public function handle($request, Closure $next)
    {
        $token = $request->header("Authorization");

        try {
            $user = JWTAuth::parseToken()->authenticate($token);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        if (in_array($user->role, [1])) { // .. Role .. = value ..
            // .. user=0 || Owner-assistant=1 || Owner=4 || Store-Owner=2 || Store-Admin=3 || ShippingAdmin=5 .. 
            return $next($request);
        }

        return response()->json(['error' => 'Role not allowed'], 403);
    }
}
