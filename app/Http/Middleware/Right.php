<?php

namespace App\Http\Middleware;

use Closure;
use Admin;

class Right
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
        if(Admin::cekRight() == 'false')
        {
            abort(401);
        }
        \Admin::activityUser();
        return $next($request);
    }
}
