<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
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
        // Not allow when user is not logged in or is not administrator.
        if (!Auth::check() || !Auth::user()->isAdmin())
        {
            return redirect(404);
        }

        return $next($request);
    }
}
