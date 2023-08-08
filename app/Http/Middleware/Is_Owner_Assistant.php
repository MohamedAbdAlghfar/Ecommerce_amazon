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
        // Get the token from the header
        $token = $request->header("Authorization");
        // Parse the token and get the user
        $user = JWTAuth::parseToken()->toUser($token);
        // .. Check User Exists ..
        if (!$user) {
            return response()->json(['user_not_found'], 404);
        }
        if (in_array($user->role, [1])) {
            return $next($request);
        } else {
            return response()->json(['role_not_allowed'], 403);
        }
    }
}
