<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthSeller
{
    /**
     * Get the path the seller should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next)
    {
        return $request->session()->has('id_seller') ? $next($request) : redirect()->route('auth');
    }
}
