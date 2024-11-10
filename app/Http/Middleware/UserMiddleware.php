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
        // if (auth('expo')->check() === false) {
        //     return back()->with('message', 'Please login first.');
        // }

        if (auth()->check() === false) {
            return redirect('/sign-in')->with('message', 'Please login first.');
        }

        return $next($request);
    }
}