<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Services\OAuthService;
use App\Services\Interfaces\OAuthServiceInterface;

class OAuthServiceProvider extends ServiceProvider
{

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        Gate::define('update-project', 'App\Policies\ProjectPolicy@update');
        Gate::define('delete-project', 'App\Policies\ProjectPolicy@delete');
    }

    public function register()
    {
        $this->app->bind(OAuthServiceInterface::class, OAuthService::class);
    }
}
