<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RevisarEstablecimiento
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(Auth()->user()->establecimiento ){
            return redirect('/establecimiento/edit');
        }
        return $next($request);
    }
}
