<?php

namespace App\Http\Middleware;

use Closure;

class AuthAPI
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->session()->has('username'))
        {
            return response()->json(['message' => 'Please login first!']);
        }

        return $next($request);
    }
}
