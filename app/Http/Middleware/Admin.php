<?php

namespace App\Http\Middleware;
use Closure;
use Auth;

class Admin
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
        // admin Role == 1
        if(Auth::check() && Auth::user()->Role == 1) {
            return $next($request);
        } else {
             return redirect()->to('login');
        }
        
    }
}
