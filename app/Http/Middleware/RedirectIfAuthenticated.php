<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
      لو كان مسجل *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::guard('web')->check()) {
            return redirect(RouteServiceProvider::HOME);
        } elseif (Auth::guard('student')->check()) {
            return redirect(RouteServiceProvider::STUDENT);
        } elseif (Auth::guard('teacher')->check()) {
            return redirect(RouteServiceProvider::TEACHER);
        } elseif (Auth::guard('parent')->check()) {
            return redirect(RouteServiceProvider::PARENT);
        }
        return $next($request);
    }
}
