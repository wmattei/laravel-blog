<?php

namespace WAuth\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Wauth\Http\Helpers\WResponse;

class WAuthServiceProvider extends ServiceProvider
{
    protected $namespace = 'WAuth\Http\Controllers';

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('wresponse', function () {

            return new WResponse();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        //
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('packages/w-auth/routes/wapi.php')); // TODO caminho relativo
    }
}
