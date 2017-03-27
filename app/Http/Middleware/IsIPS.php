<?php

namespace App\Http\Middleware;

use Closure;

class IsIPS
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
		if (!Auth::user()->isIPS())
		{
			return response('Not authorized', 401);
		}

        return $next($request);
    }
}
