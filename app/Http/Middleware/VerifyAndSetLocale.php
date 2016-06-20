<?php

namespace App\Http\Middleware;

use Closure;

class VerifyAndSetLocale
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
        $locale = $request->segment(1);

        if(! in_array($locale, config('app.locales'))) {
            $segments = array_prepend($request->segments(), config('app.fallback_locale'));

            return redirect(implode('/', $segments));
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
