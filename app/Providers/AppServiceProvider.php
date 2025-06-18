<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
         // --- INICIO DE LA MODIFICACIÓN ---
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }
        // --- FIN DE LA MODIFICACIÓN ---
    }
}
