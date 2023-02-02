<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Blade::directive('money', function ($amount) {
            return "<?php echo '₱ ' . number_format($amount, 2); ?>";
        });
        Blade::directive('date', function ($date) {
            return "<?php echo Carbon\Carbon::parse($date)->toFormattedDateString()?>";
        });
        Blade::if('isAdmin', function () {

            return auth()->check() && auth()->user()->user_level == 0;
        });
    }
}
