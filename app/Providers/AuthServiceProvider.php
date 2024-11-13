<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Define any policies here
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Definieer een Gate voor admin-toegang
        Gate::define('admin-access', function ($user) {
            return $user->rank === 'admin';
        });

        // Eventueel: Een gate voor teamleiders
        Gate::define('teamleider-access', function ($user) {
            return $user->rank === 'teamleider';
        });
    }
}
