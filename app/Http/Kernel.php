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
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'altaPuesto' => \App\Http\Middleware\altaPuesto::class,
        'editaPuesto' => \App\Http\Middleware\editaPuesto::class,
        'borraPuesto' => \App\Http\Middleware\borraPuesto::class,
        'consultaPuesto' => \App\Http\Middleware\consultaPuesto::class,
        'altaAdscripcion' => \App\Http\Middleware\altaAdscripcion::class,
        'editaAdscripcion' => \App\Http\Middleware\editaAdscripcion::class,
        'borraAdscripcion' => \App\Http\Middleware\borraAdscripcion::class,
        'consultaAdscripcion' => \App\Http\Middleware\consultaAdscripcion::class,
        'altaPersonal' => \App\Http\Middleware\altaPersonal::class,
        'editaPersonal' => \App\Http\Middleware\editaPersonal::class,
        'borraPersonal' => \App\Http\Middleware\borraPersonal::class,
        'consultaPersonal' => \App\Http\Middleware\consultaPersonal::class,
        'altaDocumento' => \App\Http\Middleware\altaDocumento::class,
        'editaDocumento' => \App\Http\Middleware\editaDocumento::class,
        'borraDocumento' => \App\Http\Middleware\borraDocumento::class,
        'consultaDocumento' => \App\Http\Middleware\consultaDocumento::class,
    ];
}
