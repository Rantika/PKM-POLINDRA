<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $guard = NULL)
    {
        if (Auth::guard($guard)->check()) {
            if (Auth::user()->hak_akses->role == "Admin") {
                return redirect("/dashboard");
            } else if(Auth::user()->hak_akses->role == "Dosen Pembimbing") {
                return redirect("/lecturer");
            } else if(Auth::user()->hak_akses->role == "Student") {
                return redirect("/team");
            } else if(Auth::user()->hak_akses->role == "Reviewer") {
                return redirect("/reviewer");
            }
        }

        return $next($request);
    }
}
