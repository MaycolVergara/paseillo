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

        // Compartir configuración globalmente de forma segura
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            try {
                $settings = \App\Models\SettingModel::first();
                $view->with('settings', $settings);
            } catch (\Exception $e) {
                $view->with('settings', null);
            }
        });
    }
}
