<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next, $guard = null)
    {
        // if ($guard === 'admin' && Auth::guard($guard)->check()) {
        //     return redirect('/admin');
        // }
        // if ($guard === 'writer' && Auth::guard($guard)->check()) {
        //     return redirect('/writer');
        // }
        // if (Auth::guard($guard)->check()) {
        //     return redirect('/home');
        // }

        // return $next($request);
        $guards = empty($guards) ? [null] : $guard;
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {

                if ($guard === 'admin') {
                    return redirect()->route('admin.home');
                }
                if ($guard === 'doctor') {
                    return redirect()->route('doctor.home');
                }
                return redirect()->route('user.home');
                // return redirect(RouteServiceProvider::HOME);
            }
        }
        return $next($request);
    }
}
