<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
        Paginator::useBootstrap();

        View::composer('*', function ($view) {
            $view->with('currentUser', Auth::user());
        });

        Blade::directive('convertCurrency', function ($value) {
            return "<?php echo convertCurrency($value); ?>";
        });
    }

    /**
     * Check if the current route has 'admin' prefix.
     */
    protected function isAdminRoute(): bool
    {
        /* $route = request()->route();
        return $route && str_starts_with($route->getPrefix(), 'admin'); */
        $route = request()->route();
        return $route && ($route->getPrefix() && (str_starts_with($route->getPrefix(), 'admin') || str_starts_with($route->getPrefix(), 'user')));
    }
}
