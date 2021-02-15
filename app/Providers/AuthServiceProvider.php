<?php

namespace App\Providers;

use App\Models\Admin\Admin;
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
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        /*$roles = Role::all();
        foreach($roles as $role){
            Gate::define($role->name, function (Admin $user,$role) {
                return $user->role_id === $role->id;
            });
        }*/
        Gate::define('isAdmin', function (Admin $user) {
            return $user->role_id === 1;
        });
        Gate::define('isIT', function (Admin $user) {
            return $user->role_id === 2;
        });
        Gate::define('isProducer', function (Admin $user) {
            return $user->role_id === 3;
        });
        Gate::define('isHR', function (Admin $user) {
            return $user->role_id === 4;
        });
    }
}
