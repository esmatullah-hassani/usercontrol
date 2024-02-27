<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \App\Http\Middleware\DebugBarMiddleware::class,
            \App\Http\Middleware\Locale::class,        
        ],

        'api' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Session\Middleware\StartSession::class,
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'role' => \DCN\RBAC\Middleware\VerifyRole::class,
        'permission' => \DCN\RBAC\Middleware\VerifyPermission::class,
        'dev' => \App\Http\Middleware\VerifyUserIsDeveloper::class,
        'survey' => \App\Http\Middleware\VerifySurvey::class,        
        'elms_check' => \App\Http\Middleware\ElmsCheckPoint::class,        
        'locale' => \App\Http\Middleware\Locale::class,
		'cors'=>\App\Http\Middleware\Cors::class,
        'student_profile_check'  => \App\Http\Middleware\StudentProfileCheckerMiddleware::class,
        'is_allowed_attachment' => \App\Http\Middleware\IsAllowedAttachmentMiddleware::class,

    ];
}