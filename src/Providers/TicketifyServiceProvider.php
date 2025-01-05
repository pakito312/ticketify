<?php
namespace Paki\Ticketify\Providers;

use Illuminate\Support\ServiceProvider;

class TicketifyServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/ticketify.php', 'ticketify');
    }

    public function boot()
{
    $this->publishes([
        __DIR__.'/../config/ticketify.php' => config_path('ticketify.php'),
        __DIR__.'/../resources/views' => resource_path('views/vendor/ticketify'),
        __DIR__.'/../database/migrations/' => database_path('migrations'),
    ], 'ticketify-resources');

    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'ticketify');

    if ($this->app->runningInConsole()) {
        $this->commands([
            \Paki\Ticketify\Console\Commands\InstallTicketify::class,
        ]);
    }
}

}
