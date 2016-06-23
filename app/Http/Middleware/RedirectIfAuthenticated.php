<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::user();
            switch($user->role){
                case 'super_super':
                    return redirect('/dashboard/manage/super-users');
                case 'super':
                    return redirect('/dashboard/manage/users');
                case 'admin':
                    return redirect('/dashboard/main');
                default:
                    return redirect('/login');
            }
        }

        return $next($request);
    }
}
