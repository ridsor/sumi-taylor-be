<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        App\Models\Pesanan::class => App\Policies\PesananPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin-super', function($user) {
            return $user->role->name === 'admin_super';
        });
        Gate::define('is-super-or-admin', function($user) {
            return $user->role->name === 'admin_super' || $user->role->name === 'admin';
        });
    }
}
