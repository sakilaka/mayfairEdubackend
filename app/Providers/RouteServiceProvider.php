<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            Route::middleware('web')
                ->group(base_path('routes/expo.php'));
            Route::middleware('web')
                ->group(base_path('routes/expo-site.php'));
            Route::middleware('web')
                ->group(base_path('routes/admin.php'));
            Route::middleware('web')
                ->group(base_path('routes/review.php'));
            Route::middleware('web')
                ->group(base_path('routes/hr_payroll.php'));
            Route::middleware('web')
                ->group(base_path('routes/courses.php'));
            Route::middleware('web')
                ->group(base_path('routes/user.php'));
            Route::middleware('web')
                ->group(base_path('routes/teacher.php'));
            Route::middleware('web')
                ->group(base_path('routes/contact.php'));
            Route::middleware('web')
                ->group(base_path('routes/event.php'));
            Route::middleware('web')
                ->group(base_path('routes/master_courses.php'));
            Route::middleware('web')
                ->group(base_path('routes/ebook.php'));
            Route::middleware('web')
                ->group(base_path('routes/location.php'));
            Route::middleware('web')
                ->group(base_path('routes/university.php'));
        });
    }
}
