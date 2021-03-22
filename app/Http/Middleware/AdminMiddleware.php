<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

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
        if( Auth::check() && Auth::user()->role_id == Config::get('constants.admin_id')){
            return $next($request);
        }
        else{
            abort(403);
        }
    }
}
