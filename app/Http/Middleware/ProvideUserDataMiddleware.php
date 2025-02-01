<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProvideUserDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // If the user is logged in, add user data to the response
        if (Auth::check()) {
            $response->setData(array_merge(
                (array) $response->getData(),
                ['user' => Auth::user()]
            ));
        } else {
            // Return a generic guest response for logged-out users
            $response->setData(array_merge(
                (array) $response->getData(),
                ['user' => null]
            ));
        }

        return $response;
    }
}