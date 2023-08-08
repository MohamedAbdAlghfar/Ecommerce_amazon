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
        if (in_array($user->role, [0,1,2,3,4])) { // .. Role .. = value ..
            // .. user=0 || Owner-assistant=1 || Owner=4 || Store-Manager=2 || Store-Admin=3 .. 
            return $next($request);
        }
    }
}
