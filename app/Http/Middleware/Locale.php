<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Locale
{
    private array $locales = [
        'en',
        'vi',
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('X-Lang') && in_array($request->header('X-Lang', 'en'), $this->locales)) {
            $locale = $request->header('X-Lang');
            app()->setLocale($locale);
        }

        return $next($request);
    }
}
