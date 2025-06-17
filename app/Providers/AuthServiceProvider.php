<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // Add your model => policy mappings if needed
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // ✅ Define is-admin gate with debug logging
        Gate::define('is-admin', function (User $user) {
            Log::info('Checking is-admin gate for user: ' . $user->id . ' | is_admin: ' . var_export($user->is_admin, true));
            return (bool) $user->is_admin;
        });
    }
}