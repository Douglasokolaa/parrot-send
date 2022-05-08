<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Parrot\Sms\SmsProvider;
use Parrot\Sms\Termii;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->scoped(SmsProvider::class, Termii::class);
    }
}
