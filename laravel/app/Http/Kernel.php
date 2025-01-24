<?php

// app/Http/Kernel.php
namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * O array de middlewares globais do aplicativo.
     *
     * Esses middlewares são executados em todas as requisições para o aplicativo.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,  
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
    ];

    /**
     * Os grupos de middlewares do aplicativo.
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
        ],

        'api' => [
                \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
    'throttle:api',
                \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * Os middlewares globais que são executados em todas as requisições.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];
}
