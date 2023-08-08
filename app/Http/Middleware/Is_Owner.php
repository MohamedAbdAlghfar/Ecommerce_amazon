<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

 // .. All Roles .. = value ..
 // .. user=0 || Owner-assistant=1 || Owner=4 || Store-Manager=2 || Store-Admin=3 ..

class Is_Owner
{
    public function handle($request, Closure $next)
    {
        $token = $request->header("Authorization");
        // Parse the token and get the user
        $user = JWTAuth::parseToken()->toUser($token);
        if (!$user) {
            return response()->json(['user_not_found'], 404);
        }
        if (in_array($user->role, [4])) { // .. Role .. = value ..
            // .. user=0 || Owner-assistant=1 || Owner=4 || Store-Owner=2 || Store-Admin=3 ..           
            return $next($request);
        } else {
            return response()->json(['role_not_allowed'], 403);
        }
    }
}
