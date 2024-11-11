<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // if (auth()->check()) {
        //     $UserIP=$_SERVER['REMOTE_ADDR'];
        //     $browser_address=$_SERVER['HTTP_USER_AGENT'];
        //     $user_access = Useraccess::where('user_id',auth()->user()->id)->where('ip_address',$UserIP)->where('browser_address',$browser_address)->first();
        //     if($user_access == null){
        //         auth()->checkout();
        //     }
        // }
        return $request->expectsJson() ? null : route('login');
    }
}
