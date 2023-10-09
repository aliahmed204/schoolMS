<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Request as FRequest;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated. عسكرى المرور
     */
    protected function redirectTo($request): ?string
    {
        if(!$request->expectsJson()){
            if(FRequest::is(app()->getLocale().'/student/dashboard')){
                return route('selection');
            }elseif(FRequest::is(app()->getLocale().'/teacher/dashboard')){
                return route('selection');
            }elseif(FRequest::is(app()->getLocale().'/parent/dashboard')){
                return route('selection');
            }
        }
        return route('selection');
    }
}
