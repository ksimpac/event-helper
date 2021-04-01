<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class isHaveEventPermission
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
        $current_poster = $request->event->poster;

        return $current_poster == '系辦' && Auth::guard('manager')->check() == true ?
            abort(403) : $next($request);
    }
}
