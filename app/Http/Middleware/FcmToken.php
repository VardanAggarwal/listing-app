<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FcmToken
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
        if($request->has('fcmtoken') && isset(Auth::user()->profile)){
            $profile=Auth::user()->profile;
            $profile->fcmtoken=$request->fcmtoken;
            $profile->save();
        }
        return $next($request);
    }
}
