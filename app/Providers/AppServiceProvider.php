<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        // Esto detecta si estás en Render y fuerza el candado de seguridad
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        // Compartir configuración globalmente
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            $settings = \App\Models\SettingModel::first();
            $view->with('settings', $settings);
        });
    }
}
