<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class User
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
        $STU_ID = $request->route()->parameter('STU_ID');
        return Auth::user()->type != 'user' || Auth::user()->STU_ID != $STU_ID ? abort(404) : $next($request);
    }
}
