<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Services\AuthService;
use App\Services\Interfaces\AuthServiceInterface;


class AuthServiceProvider extends ServiceProvider
{

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(User $user)
    {
        #Ignore to all gate restrictions if user this an admin
        Gate::before(function ($user) {
            if ($user->isAdmin()) {
                return true;
            }
        });

        #I have no idea what that is
        Gate::define('update-project', 'App\Policies\ProjectPolicy@update');
        Gate::define('delete-project', 'App\Policies\ProjectPolicy@delete');
        Gate::define('adm-form', 'App\Policies\ProjectPolicy@admin_form');
        Gate::define('appraiser-form', 'App\Policies\ProjectPolicy@appraiser_form');
        Gate::define('not-user-or-appraiser', 'App\Policies\ProjectPolicy@user_appraiser');
        # Define Gates for check user level contains a permission
        # Check Schema::hasTable for fix migrate error.
        if (Schema::hasTable('permission')) {
            $permissions = Permission::all();
            foreach ($permissions as $permission) {
                Gate::define($permission->name, function ($user) use ($permission) {
                    return $permission->hasLevel($user->level);
                });
            }
        }
    }

    public function register()
    {
        $this->app->bind(AuthServiceInterface::class, AuthService::class);
    }
}
