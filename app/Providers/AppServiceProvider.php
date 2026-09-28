<?php

namespace App\Providers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Sentry\State\Scope;
use function Sentry\configureScope;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        configureScope(function (Scope $scope): void {
            $scope->setTag('client', (string) config('http-logger.context.client'));
        });

        Log::shareContext(['client' => config('http-logger.context.client')]);
    }
}
