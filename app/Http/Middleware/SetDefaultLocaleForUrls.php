<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class SetDefaultLocaleForUrls
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->post('lang');
        if (in_array($lang, ['en', 'uk'])) {
            $request->session()->put('locale', $lang);
        }

        $request->session()->has('locale') ? app()->setLocale($request->session()->get('locale')) : app()->setLocale(config('app.fallback_locale'));

        // Adding locale prefix itself
        URL::defaults(['locale' => app()->getLocale()]);

        return $next($request);
    }
}
