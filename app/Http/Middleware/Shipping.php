<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Shipping
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
        if(Auth::check() && Auth::User()->Role == 2){

            return $next($request);

        }else{
            return redirect()->to('login');
        }
    }
}
