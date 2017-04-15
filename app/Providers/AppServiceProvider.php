<?php

namespace App\Providers;

use App;
use Auth;
use Blade;
use Request;
use Carbon\Carbon;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('saam', 'SAAM');
        View::share('taxi', 'TAXI');
        Blade::directive('jsonify', function ($expression) {
            return "<?php echo json_encode($expression); ?>";
        });
        Validator::extend('sizeOfPhone', function($attribute, $value, $parameters, $validator) {
            return strlen($value) == 10 || strlen($value) == 11;
        });

        Validator::replacer('sizeOfPhone', function($message, $attribute, $rule, $parameters) {
            return __('validation.sizeOfPhone');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment('local', 'testing')) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
