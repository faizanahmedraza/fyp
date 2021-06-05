<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class UnAuthentic
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
        if(Auth::check()){
            if(Str::contains(request()->url(),'admin')){
                return redirect('/admin/dashboard');
            } else {
                return redirect('/student/dashboard');
            }
        }
        return $next($request);
    }
}
