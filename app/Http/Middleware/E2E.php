<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class E2E
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
        if(Auth::user()){
            if(isset(Auth::user()->profile->personas)){
                if($request->is('e2e/login')){
                    return redirect('e2e');
                }
                return $next($request);            
            }else if($request->is('e2e/role')){
                return $next($request);
            }else{
                app('redirect')->setIntendedUrl($request->url());
                return redirect('e2e/role');
            }
        }elseif(session()->has('role')){
            if($request->is('e2e/login')||$request->is('e2e/role')){
                return $next($request);
            }
            app('redirect')->setIntendedUrl($request->url());
            return redirect('e2e/login');
        }else{
            if($request->is('e2e/role')){
                return $next($request);
            }else{
                app('redirect')->setIntendedUrl($request->url());
                return redirect('e2e/role');
            }
        }
        return redirect(RouteServiceProvider::HOME);
    }
}
