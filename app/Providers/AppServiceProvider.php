<?php

namespace App\Providers;

use App\Helpers\PackageManager;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    private $packageManager;

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // share app settings with all views
        View::share('settings', (object)config('settings'));
        // extra class for background
        View::share('inverted', config('settings.background')=='black' ? 'inverted' : '');
        // log DB queries
        DB::listen(function ($query) {
            Log::debug($query->sql, ['params' => $query->bindings, 'time' => $query->time]);
        });

        // add @env('???') if directive
        Blade::if('env', function ($environment) {
            return app()->environment($environment);
        });

        // add @social Blade if directive
        Blade::if('social', function ($provider = NULL) {
            $providers = $provider ? [$provider] : ['facebook','google','twitter','linkedin'];

            $check = function($p) {
                return config('services.'.$p.'.client_id')
                && config('services.'.$p.'.client_secret')
                && config('services.'.$p.'.redirect');
            };

            // if at least one provider is enabled return true
            foreach ($providers as $p) {
                if ($check($p))
                    return TRUE;
            }

            return FALSE;
        });

        // custom blade directive to load package views
        Blade::directive('packageview', function ($view) {
            $view = str_replace('\'', '', $view); // remove single quotes from the beginning and the end
            $expression = '';

            // loop through installed packages and check if they implement given view name
            foreach ($this->packageManager->getInstalled() as $package) {
                if (view()->exists($package->id . '::' . $view)) {
                    $expression .= 'echo $__env->make("' . $package->id . '::' . $view . '", array_except(get_defined_vars(), array("__data", "__path")))->render();';
                }
            }

            return $expression ? '<?php ' . $expression . '?>' : '';
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $packageManager = new PackageManager();
        $this->packageManager = $packageManager;

//        dd($packageManager->getInstalled());

        // if any extra packages are installed
        if (count($packageManager->getInstalled())) {
            // auto load package classes
            spl_autoload_register([$packageManager, 'autoload']);

            // register package service providers
            foreach ($packageManager->getInstalled() as $package) {
                foreach ($package->providers as $provider) {
                    $this->app->register($provider);
                }
            }
        }
    }
}
