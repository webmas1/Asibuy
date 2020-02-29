<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class AdminPanelGuard
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
        if (Session::get('user_role') != 'admin') {
            return redirect('/');
        }
        return $next($request);
    }
}
