<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Blade::directive('activeRoute', function ($route) {

            return "<?php echo Route::currentRouteName() == $route ? 'bg-green-600 dark:bg-green-700' : ''; ?>";

        });
    }
}
