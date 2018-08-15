<?php

namespace App\Http\Middleware;

use Closure;

class GoodsOwner
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
        if(true)
            return $next($request);
        else return false;
    }
}
