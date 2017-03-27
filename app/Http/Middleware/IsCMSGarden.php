<?php

namespace App\Http\Middleware;

use Closure;

class IsCMSGarden
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
		if (!Auth::user()->isCMSGarden())
		{
			return response('Not authorized', 401);
		}

        return $next($request);
    }
}
