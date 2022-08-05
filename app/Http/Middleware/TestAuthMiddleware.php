<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TestAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    protected function redirectTo(Request $request, Closure $next)
    {
        if(! $request->expectsJson()){
            return route("testlogin");
        }

        return $next($request);
    }
}
