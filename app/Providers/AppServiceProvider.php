<?php

namespace App\Providers;

use App\Enums\RoleEnum;
use App\Models\Language;
use App\Models\User;
use App\Policies\LanguagePolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
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
        Schema::defaultStringLength(191);
        $this->configureInertia();
        $this->configureCommands();
        $this->configureModels();
        $this->configureVite();
        $this->configureGates();
    }

    /**
     * Configure Inertia to share data with all components in all requests.
     *
     * @return void
     */
    private function configureInertia(): void
    {
        Inertia::share('localizations', function () {
            $languages = [];

            foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties) :

                $languages[$localeCode] = [
                    'path'      => LaravelLocalization::getLocalizedURL($localeCode, null, [], true),
                    'native'    => $properties['native'],
                    'code'      => strtoupper($localeCode), 
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

    /**
     * Configure gates
     *
     * @return void
     */
    private function configureGates(): void
    {
        /**
         * Allow admin to do anything
         *
         * @param User $user
         * @param string $ability
         *
         * @return Response|null
         */
        Gate::before(function (User $user, string $ability) {
            if ($user->hasRole(RoleEnum::ADMIN)) {
                return Response::allow();
            }

            return null;
        });
    }
}
