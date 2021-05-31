<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard === 'admin' && Auth::guard($guard)->check()) {
            return redirect('/admin');
        }
        if ($guard === 'writer' && Auth::guard($guard)->check()) {
            return redirect('/writer');
        }
        if ($guard === 'teacher' && Auth::guard($guard)->check()) {
            return redirect('/teacher');
        }
        if ($guard === 'guardian' && Auth::guard($guard)->check()) {
            return redirect('/guardian');
        }
        if ($guard === 'doctor' && Auth::guard($guard)->check()) {
            return redirect('/doctor');
        }
        if ($guard === 'nurse' && Auth::guard($guard)->check()) {
            return redirect('/nurse');
        }
        if (Auth::guard($guard)->check()) {
            return redirect('/home');
        }

        return $next($request);
    }
}
