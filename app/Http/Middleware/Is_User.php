<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Is_User
{
    public function handle($request, Closure $next)
    {
        $token = $request->header("Authorization");

        $user = JWTAuth::parseToken()->toUser($token);

        if (!$user) {
            return response()->json(['user_not_found'], 404);
        }
        // .. If Authorized , Then He Can Access ..
        return $next($request);
    }
}
