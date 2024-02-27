<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;

class CustomLoginController extends Controller
{
    use ThrottlesLogins;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        header("Access-Control-Allow-Origin: https://knu.edu.af");
    
        $validator = \Validator::make($request->all(), [
            'email' => 'required', 
            'password' => 'required',
        ]);
            
        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        
        if ($this->attemptLogin($request)) {
            return $this->sendLoginResponse($request);
        }

        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function sendLockoutResponse(Request $request)
    {
        $seconds = $this->limiter()->availableIn(
            $this->throttleKey($request)
        );

        $message = trans('auth.throttle', ['seconds' => $seconds]);

        return response()->json(['seconds' => $seconds]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), false
        );
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        return response()->json([
            'login' => true,
            'fa' => auth()->user()->google2fa_secret != ''
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        return response()->json(['errors' => [$this->username() => trans('auth.failed')]]);      
    }

    public function username()
    {
        return 'email';
    }

    protected function credentials(Request $request)
    {
        return json_decode($request->getContent(), true);
    }

    protected function guard()
    {
        return \Auth::guard();
    }
}