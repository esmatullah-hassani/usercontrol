<?php

namespace App\Http\Middleware;

use Closure;
use App;

class Locale
{

    protected $lang;

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->check()){
            $lang = auth()->user()->locale;
//            dd($lang);
            if (is_null($lang))
            {
                auth()->user()->update([
                    'locale'=>'da'
                ]);
                app()->setLocale('da');
            }

            else
                app()->setLocale($lang);
        }
        else {
            app()->setLocale('da');
        }

        return $next($request);
    }
}