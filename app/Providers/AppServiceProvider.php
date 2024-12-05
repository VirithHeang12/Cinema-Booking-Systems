<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
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
        // share languages with Inertia
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
}
