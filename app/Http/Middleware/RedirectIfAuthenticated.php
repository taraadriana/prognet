<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle($request, Closure $next, $guards = null)
    {
        switch ($guards){
            case'admin':
                if(Auth::guard($guards)->check()){
                    return redirect()->route('admin.dashboard');
                }
                break;
            default:
                if(Auth::guard($guards)->check()){
                    return redirect()->route('home');
                }
                break;
        }

            if (Auth::guard($guards)->check()) {
                return redirect(RouteServiceProvider::HOME);
            }

        return $next($request);
    }
}
