<?php
namespace Mabadir\LaravelCypress;

use Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mabadir\LaravelCypress\Console\Commands\AddCypressCommands;

class LaravelCypressServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AddCypressCommands::class,
            ]);
        }

        if(request()->getHttpHost() === config("cypress.url"))
        {
            config(["database.connections.".config("database.default").".database"
                        => config("cypress.db")]);
            if(file_exists(base_path('/routes/acceptance.php')))
            {
                Route::prefix("__testing__")
                    ->middleware("web")
                    ->group(base_path('/routes/acceptance.php'));
            }

            Route::middleware("web")
                ->group(__DIR__."/routes/acceptance.php");

        }

        $this->publishes([
            __DIR__."/../config/cypress.php" => config_path("cypress.php"),
        ]);
    }

    public function register()
    {

    }
}