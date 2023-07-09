<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Is_User
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->kind==0)
        {
            return $next($request);
        }
        // .. If Not User , Redirect To Login Page ..
        return redirect()->route('signup');
              
    }
}
