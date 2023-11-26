<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthClient
{
    /**
     * Get the path the client should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next)
    {
        return $request->session()->has('id_client') ? $next($request) : redirect()->route('auth');
    }
}
