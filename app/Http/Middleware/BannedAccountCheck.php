<?php

namespace App\Http\Middleware;

use Closure;

class BannedAccountCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user()->banned)
            return redirect(route('banned'));

        return $next($request);
    }
}
