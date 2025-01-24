<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Defina o namespace para as rotas da aplicação.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Registre os serviços de rotas para a aplicação.
     *
     * @return void
     */
    public function boot()
    {
        $this->routes(function () {
            Route::prefix('api') // Prefixo para as rotas de API
                ->middleware('api') // Middleware de API
                ->namespace($this->namespace) // Namespace dos controladores
                ->group(base_path('routes/api.php')); // Arquivo onde as rotas da API são definidas

            // Você pode adicionar outras configurações de rotas, como as de web, aqui.
            Route::middleware('web') // Middleware de Web
                ->namespace($this->namespace) // Namespace dos controladores
                ->group(base_path('routes/web.php')); // Arquivo onde as rotas da web são definidas
        });
    }

    /**
     * Registre as rotas para o aplicativo.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
