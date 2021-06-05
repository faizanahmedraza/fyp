<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class NotAdmin
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
        if(Auth::check() && (in_array(Auth::user()->roles()->pluck('name')->first(),['super-admin','admin']))){
            return redirect('/admin/dashboard');
        }
        return $next($request);
    }
}
