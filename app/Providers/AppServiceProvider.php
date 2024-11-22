<?php

namespace App\Providers;
use Illuminate\Foundation\Application;
//use Illuminate\Support\ServiceProvider;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;
use App\Models\Role_user;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('path.public', function() {
            return base_path() . '/public_html';
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->app->bind('path.public', function() {
            return base_path() . '/public_html';
        });

        $this->registerPolicies();

        // Define gates for roles
        // Gate::define('access-admin', function ($user) {
        //     return $user->hasRole('admin');
        // });

        // Gate::define('access-staff', function ($user) {
        //     return $user->hasRole('staff');
        // });

        // Gate::define('access-user', function ($user) {
        //     return $user->hasRole('user');
        // });

        Gate::define('access-admin', function ($user) {
            return $user->roles()->where('role_id', 1)->exists();
        });
    
        Gate::define('access-staff', function ($user) {
            return $user->roles()->where('role_id', 2)->exists();
        });
    }
}
