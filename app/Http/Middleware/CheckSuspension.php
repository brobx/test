<?php

namespace App\Http\Middleware;

use Closure;

class CheckSuspension
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->user() && $request->user()->suspended) {
            auth()->logout();

            return redirect()->action('Auth\AuthController@login')->withErrors([
                'suspended' => 'This Account was suspended.'
            ]);
        }

        return $next($request);
    }
}
