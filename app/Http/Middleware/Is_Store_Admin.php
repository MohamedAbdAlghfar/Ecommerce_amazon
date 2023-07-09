<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Is_Store_Admin
{
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->kind==4)
        {
            return $next($request);
        }if(Auth::user()->kind== 3 or 1 or 0){
            return back();
        }
        // .. If Not User , Redirect To Login Page ..
        return redirect()->route('signup');
    }
}
