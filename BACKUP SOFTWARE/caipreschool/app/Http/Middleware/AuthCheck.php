<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
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
        if(!session()->has('LoggedUser') && ($request->path() != 'login' && $request->path() != 'register')){
            return redirect('login')->with('fail','You must be logged in');
        }

        if(session()->has('LoggedUser') && ($request->path() == 'login' || $request->path() == 'register')){
            return back();
        }

        if(session()->has('LoggedUser') && ($request->path() == '/')){
            return redirect('parent/home');
        }

        return $next($request);
    }
}
