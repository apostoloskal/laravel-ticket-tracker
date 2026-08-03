<?php

namespace App\Providers;

use App\Models\EmployeeProfile;
use App\Policies\EmployeePolicy;
use Gate;
use Illuminate\Support\ServiceProvider;

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
        Gate::policy(EmployeeProfile::class, EmployeePolicy::class);
    }
}
