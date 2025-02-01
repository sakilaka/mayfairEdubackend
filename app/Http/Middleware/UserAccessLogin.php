<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Useraccess;

class UserAccessLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!(auth()->check())) {
            /* $UserIP=$_SERVER['REMOTE_ADDR'];
            $browser_address=$_SERVER['HTTP_USER_AGENT'];
            $user_access = Useraccess::where('user_id',auth()->user()->id)->where('ip_address',$UserIP)->where('browser_address',$browser_address)->first();
            if($user_access == null){
                auth()->logout();
            } */
            auth()->logout();
        }
        return $next($request);
    }
}