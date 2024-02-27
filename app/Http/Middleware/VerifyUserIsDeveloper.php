<?php

namespace App\Http\Middleware;

class VerifyUserIsDeveloper
{
    /**
     * Determine if the authenticated user is a developer.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, $next)
    {
        if ($request->user() && $request->user()->isDeveloper()) {
            return $next($request);
        }

        return $request->ajax() || $request->wantsJson()
                        ? response('Unauthorized.', 401)
                        : redirect()->back();
    }
}
