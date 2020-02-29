<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class CrmGuard
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
        if (!Session::has('user_id')) {
            Session::put('previous_page',url()->current());
            return redirect('user/signin');
        }
        return $next($request);
    }
}
