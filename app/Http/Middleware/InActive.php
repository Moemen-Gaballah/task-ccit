<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // TODO - best way override method login and remove this middleware
        if (auth()->user() &&  auth()->user()->status == 'inactive') {

            auth()->logout();

            // TODO Return Route => with msg + contact us
            return redirect('/');
        }


        return $next($request);
    }
}
