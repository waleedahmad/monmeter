<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class IsSuperUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        switch($user->role){
            case 'super_super':
                return redirect('/dashboard/manage/super-users');
            case 'admin':
                return redirect('/dashboard/main');
        }
        return $next($request);
    }
}
