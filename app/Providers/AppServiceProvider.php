<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        $this->configureInertia();
        $this->configureCommands();
        $this->configureModels();
        $this->configureVite();
    }

    /**
     * Configure Inertia to share data with all components in all requests.
     *
     * @return void
     */
    private function configureInertia(): void
    {
        Inertia::share('languages', function () {
            $languages = [];

            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) :

                $languages[$localeCode] = [
                    'path'      => LaravelLocalization::getLocalizedURL($localeCode, null, [], true),
                    'native'    => $properties['native'],
                    'active'    => LaravelLocalization::getCurrentLocale() == $localeCode,
                ];
            endforeach;

            return $languages;
        });
    }

    /**
     * Configure to prevent destructive commands from running in production.
     *
     * @return void
     */
    private function configureCommands(): void
    {
        DB::prohibitDestructiveCommands($this->app->environment('production'));
    }

    /**
     * Configure Eloquent models to be strict.
     */
    private function configureModels(): void
    {
        Model::shouldBeStrict();
    }

    /**
     * Configure Vite
     *
     * @return void
     */
    private function configureVite(): void
    {
        Vite::usePrefetchStrategy('aggressive');
    }
}
