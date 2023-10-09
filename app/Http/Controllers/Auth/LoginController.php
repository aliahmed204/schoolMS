<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    public function loginForm($type){
        return view('auth.login',compact('type'));
    }

    public function login(Request $request , $type){

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required' ,'string','max:20'],
        ]);

        if(Auth::guard($type)->attempt($credentials)){
            if($request->type == 'student'){
                return redirect()->intended(RouteServiceProvider::STUDENT);
            }
            elseif ($request->type == 'parent'){
                return redirect()->intended(RouteServiceProvider::PARENT);
            }
            elseif ($request->type == 'teacher'){
                return redirect()->intended(RouteServiceProvider::TEACHER);
            }
            elseif ($request->type == 'web'){
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }else{
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ])->onlyInput('email');
        }
    }

    public function logout(Request $request , $type){
        Auth::guard($type)->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('selection');
    }


     /**
     * Create a new controller instance.
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
