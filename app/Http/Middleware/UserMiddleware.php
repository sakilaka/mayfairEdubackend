<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if (auth()->check() === false) {

            return redirect('/sign-in')->with('message', 'Please login first.');
        }
        return $next($request);



        // if (auth()->check() && auth()->user()->type == $userCheck)
        // {
        //     return $next($request);
        // }
        // else
        // {
        //     return redirect('/sign-in')->with('message', 'Please login first.');
        // }

        
    }
}
