<?php

namespace App\Http\Middleware;

use Closure;

class MustHaveRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role = 'admin')
    {
        $user = $request->user();

        // redirect login if not signed in.
        if(! $user) {
            return redirect('/login');
        }

        if(! $user->is($role)) {
            return redirect('/');
        }

        return $next($request);
    }
}
