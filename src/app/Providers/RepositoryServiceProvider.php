<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\{ ProjectsService, Interfaces\ProjectsServiceInterface };

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any repositories.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Contracts\Repository',
            'App\Repositories\GroupRepository'
        );

        $this->app->bind(
            'App\Contracts\Repository',
            'App\Repositories\MissionRepository'
        );
    }
}
