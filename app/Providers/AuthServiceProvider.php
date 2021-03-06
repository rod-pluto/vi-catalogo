<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin-access', function ($user) {
            return $user->roles[0]->name == 'admin' ? true : false;
        });

        Gate::define('admin-dealer-access', function ($user) {
            return ($user->roles[0]->name == 'admin') || ($user->roles[0]->name == 'dealer')  ? true : false;
        });

        Gate::define('customer-access', function ($user) {
            return $user->roles[0]->name == 'customer' ? true : false;
        });
    }
}
