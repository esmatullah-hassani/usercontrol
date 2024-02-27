<?php

namespace App\Http\Middleware;

use Closure;

class DebugBarMiddleware
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
        if (! auth()->check()) {
            \Debugbar::disable();    
        }

        if(auth()->check() and ! auth()->user()->isDeveloper()) {
            \Debugbar::disable();    
        }
        
        return $next($request);
    }
}
