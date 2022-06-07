<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Role
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
        return $next($request);
        if (! Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role_id == 1 OR Auth::user()->role_id == 2) {
            return redirect()->route('dashboard');
        }else{
            return redirect()->route('login')->with('error', 'You Dont Have Permission');
        }


    }
}
